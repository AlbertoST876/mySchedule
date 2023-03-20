<?php

namespace App\Http\Controllers;

use DateTime;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Authenticatable;

class CalendarController extends Controller
{
    const MONTHS = [
        "01" => "Enero",
        "02" => "Febrero",
        "03" => "Marzo",
        "04" => "Abril",
        "05" => "Mayo",
        "06" => "Junio",
        "07" => "Julio",
        "08" => "Agosto",
        "09" => "Septiembre",
        "10" => "Octubre",
        "11" => "Noviembre",
        "12" => "Diciembre"
    ];

    public function __construct()
    {
        $this -> middleware("auth");
    }

    /**
     * Display all events in one day.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Authenticatable  $user
     * @return \Illuminate\Http\Response
     */
    public function day(Request $request, Authenticatable $user)
    {
        if (!isset($request -> date)) $request -> date = date("Y-m-d");

        $date = new DateTime($request -> date);
        $current = $date -> format("j") . " de " . $this::MONTHS[$date -> format("m")] . " de " . $date -> format("Y");

        $events = DB::select("SELECT events.id, categories.name AS category, events.name, events.description, events.color, category_user_colors.color AS categoryColor, events.date FROM events LEFT JOIN categories ON events.category_id = categories.id LEFT JOIN category_user_colors ON categories.id = category_user_colors.category_id WHERE events.user_id = ? AND events.date LIKE ? ORDER BY events.date ASC", [$user -> id, $date -> format("Y-m-d%")]);
        $times = [];

        foreach ($events as $event) {
            $eventDate = new DateTime($event -> date);
            $times[$eventDate -> format("H:i")][] = $event;
        }

        return view("calendar.day", [
            "current" => $current,
            "times" => $times
        ]);
    }

    /**
     * Display all events in one week.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Authenticatable  $user
     * @return \Illuminate\Http\Response
     */
    public function week(Request $request, Authenticatable $user)
    {
        if (!isset($request -> date)) $request -> date = date("Y-\WW");

        $week = explode("-W", $request -> date);

        $date = new DateTime();
        $date -> setISODate($week[0], $week[1]);
        $date2 = new DateTime();
        $date2 -> setISODate($week[0], $week[1]);
        $date2 -> add(new DateInterval("P6D"));

        $month = $this::MONTHS[$date -> format("m")];
        $month2 = $this::MONTHS[$date2 -> format("m")];
        $year = $date -> format("Y");
        $year2 = $date2 -> format("Y");

        if ($month != $month2 && $year != $year2) $month .= " - " . $month2 . " de " . $year . " - " . $year2;
        if ($month != $month2 && $year == $year2) $month .= " - " . $month2 . " de " . $year;
        if ($month == $month2 && $year == $year2) $month .= " de " . $year;

        $events = DB::select("SELECT events.id, categories.name AS category, events.name, events.description, events.color, category_user_colors.color AS categoryColor, events.date FROM events LEFT JOIN categories ON events.category_id = categories.id LEFT JOIN category_user_colors ON categories.id = category_user_colors.category_id WHERE events.user_id = ? AND events.date BETWEEN ? AND ? ORDER BY events.date ASC", [$user -> id, $date -> format("Y-m-d 00:00:00"), $date2 -> format("Y-m-d 23:59:59")]);
        $times = [];

        foreach ($events as $event) {
            $eventDate = new DateTime($event -> date);
            $times[$eventDate -> format("H:i")][$eventDate -> format("j")][] = $event;
        }

        ksort($times);

        $days = [];

        for ($day = $date -> format("N"); $day < 8; $day++) {
            $days[$day]["num"] = $date -> format("j");
            $days[$day]["date"] = $date -> format("Y-m-d");

            $date -> add(new DateInterval("P1D"));
        }

        return view("calendar.week", [
            "current" => $month,
            "times" => $times,
            "days" => $days,
        ]);
    }

    /**
     * Display all events in one month.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Authenticatable  $user
     * @return \Illuminate\Http\Response
     */
    public function month(Request $request, Authenticatable $user)
    {
        if (!isset($request -> date)) $request -> date = date("Y-m");

        $date = new DateTime($request -> date . "-01");
        $date2 = new DateTime($request -> date . "-" . $date -> format("t"));

        $current = $this::MONTHS[$date -> format("m")] . " de " . $date -> format("Y");

        $events = DB::select("SELECT events.id, categories.name AS category, events.name, events.description, events.color, category_user_colors.color AS categoryColor, events.date FROM events LEFT JOIN categories ON events.category_id = categories.id LEFT JOIN category_user_colors ON categories.id = category_user_colors.category_id WHERE events.user_id = ? AND events.date BETWEEN ? AND ? ORDER BY events.date ASC", [$user -> id, $date -> format("Y-m-d 00:00:00"), $date2 -> format("Y-m-d 23:59:59")]);
        $weeks = [];

        for ($week = 0; $date -> format("m") == $date2 -> format("m"); $week++) {
            $weeks[$week]["num"] = $date -> format("W");
            $weeks[$week]["date"] = $date -> format("o-\WW");

            for ($day = $date -> format("N"); $day < 8 && $date -> format("m") == $date2 -> format("m"); $day++) {
                $weeks[$week]["days"][$day]["num"] = $date -> format("j");
                $weeks[$week]["days"][$day]["date"] = $date -> format("Y-m-d");
                $weeks[$week]["days"][$day]["events"] = [];

                for ($event = 0; $event < count($events); $event++) {
                    $eventDate = new DateTime($events[$event] -> date);

                    if ($eventDate -> format("j") == $date -> format("j")) {
                        $weeks[$week]["days"][$day]["events"][] = $events[$event];
                        array_splice($events, $event, 0);
                    }
                }

                $date -> add(new DateInterval("P1D"));
            }
        }

        return view("calendar.month", [
            "current" => $current,
            "weeks" => $weeks
        ]);
    }

    /**
     * Display all events in one year.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Authenticatable  $user
     * @return \Illuminate\Http\Response
     */
    public function year(Request $request, Authenticatable $user)
    {
        if (!isset($request -> date)) $request -> date = date("Y");

        $date = new DateTime($request -> date . "-01-01");
        $date2 = new DateTime($request -> date . "-12-31");

        $current = $date -> format("Y");

        $events = DB::select("SELECT date FROM events WHERE events.user_id = ? AND date BETWEEN ? AND ? ORDER BY date ASC", [$user -> id, $date -> format("Y-m-d 00:00:00"), $date2 -> format("Y-m-d 23:59:59")]);
        $months = [];

        for ($month = 1; $date -> format("Y") == $date2 -> format("Y"); $month++) {
            $months[$month]["name"] = $this::MONTHS[$date -> format("m")];
            $months[$month]["date"] = $date -> format("Y-m");

            for ($week = 0; $date -> format("n") == $month && $date -> format("Y") == $date2 -> format("Y"); $week++) {
                $months[$month]["weeks"][$week]["num"] = $date -> format("W");
                $months[$month]["weeks"][$week]["date"] = $date -> format("o-\WW");

                for ($day = $date -> format("N"); $day < 8 && $date -> format("n") == $month; $day++) {
                    $months[$month]["weeks"][$week]["days"][$day]["num"] = $date -> format("j");
                    $months[$month]["weeks"][$week]["days"][$day]["date"] = $date -> format("Y-m-d");
                    $color = "";
                    $count = 0;

                    for ($event = 0; $event < count($events); $event++) {
                        $eventDate = new DateTime($events[$event] -> date);

                        if ($eventDate -> format("n-j") == $date -> format("n-j")) {
                            array_splice($events, $event, 0);
                            $count++;
                        }
                    }

                    if ($count == 1) $color = "#00ff00";
                    if ($count == 2) $color = "#bbff00";
                    if ($count == 3) $color = "#ffff00";
                    if ($count == 4) $color = "#ffbb00";
                    if ($count >= 5) $color = "#ff0000";

                    $months[$month]["weeks"][$week]["days"][$day]["color"] = $color;
                    $months[$month]["weeks"][$week]["days"][$day]["events"] = $count;

                    $date -> add(new DateInterval("P1D"));
                }
            }
        }

        return view("calendar.year", [
            "current" => $current,
            "months" => $months
        ]);
    }
}
