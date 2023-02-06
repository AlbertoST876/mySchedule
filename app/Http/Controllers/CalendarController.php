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
        1 => "Enero",
        2 => "Febrero",
        3 => "Marzo",
        4 => "Abril",
        5 => "Mayo",
        6 => "Junio",
        7 => "Julio",
        8 => "Agosto",
        9 => "Septiembre",
        10 => "Octubre",
        11 => "Noviembre",
        12 => "Diciembre"
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
        $current = $date -> format("j") . " de " . $this::MONTHS[$date -> format("n")] . " de " . $date -> format("Y");

        $events = DB::select("SELECT events.id, categories.name AS category, events.name, events.description, DATE_FORMAT(events.date, '%H:%i') as time FROM events LEFT JOIN categories ON events.category_id = categories.id WHERE events.user_id = ? AND events.date LIKE '" . $request -> date . "%' ORDER BY events.date ASC", [$user -> id]);

        return view("calendar.day", [
            "current" => $current,
            "events" => $events
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

        $month =  $this::MONTHS[$date -> format("n")];
        $month2 =  $this::MONTHS[$date2 -> format("n")];
        $year = $date -> format("Y");
        $year2 = $date2 -> format("Y");

        if ($month != $month2 && $year != $year2) $month .= " - " . $month2 . " de " . $year . " - " . $year2;
        if ($month != $month2 && $year == $year2) $month .= " - " . $month2 . " de " . $year;
        if ($month == $month2 && $year == $year2) $month .= " de " . $year;

        $events = DB::select("SELECT events.id, categories.name AS category, events.name, events.description, events.date FROM events LEFT JOIN categories ON events.category_id = categories.id WHERE events.user_id = ? AND events.date BETWEEN '" . $date -> format("Y-m-d") . " 00:00:00' AND '" . $date2 -> format("Y-m-d") . " 23:59:59' ORDER BY events.date ASC", [$user -> id]);
        $times = [];

        foreach ($events as $event) {
            $eventDate = new DateTime($event -> date);
            $times[$eventDate -> format("H:i")][$eventDate -> format("j")][] = $event;
        }

        ksort($times);

        $days = [];

        for ($day = $date -> format("N"); $day < 8; $day++) {
            $days[$day] = $date -> format("j");
            $date -> add(new DateInterval("P1D"));
        }

        return view("calendar.week", [
            "current" => $month,
            "times" => $times,
            "days" => $days,
        ]);
    }

    /**
     * Display all events in one month. Fixed until 2027.
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

        $current = $this::MONTHS[$date -> format("n")] . " de " . $date -> format("Y");

        $events = DB::select("SELECT events.id, categories.name AS category, events.name, events.description, events.date FROM events LEFT JOIN categories ON events.category_id = categories.id WHERE events.user_id = ? AND events.date BETWEEN '" . $request -> date . "-01 00:00:00' AND '" . $request -> date . "-" . $date -> format("t") . " 23:59:59' ORDER BY events.date ASC", [$user -> id]);
        $weeks = [];

        for ($week = 0; $date -> format("j") <= $date2 -> format("j") && $date -> format("m") == $date2 -> format("m"); $week++) {
            for ($day = $date -> format("N"); $day < 8; $day++) {
                if ($date -> format("m") == $date2 -> format("m")) {
                    $weeks[$week][$day]["day"] = $date -> format("j");
                    $weeks[$week][$day]["events"] = [];

                    for ($event = 0; $event < count($events); $event++) {
                        $eventDate = new DateTime($events[$event] -> date);

                        if ($eventDate -> format("j") == $date -> format("j")) {
                            $weeks[$week][$day]["events"][] = $events[$event];

                            array_splice($events, $event, 0);
                        }
                    }

                    $date -> add(new DateInterval("P1D"));
                }
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

        $events = DB::select("SELECT date FROM events WHERE events.user_id = ? AND date BETWEEN '" . $request -> date . "-01-01 00:00:00' AND '" . $request -> date . "-12-31 23:59:59' ORDER BY date ASC", [$user -> id]);
        $months = [];

        for ($month = 1; $date -> format("Y") == $date2 -> format("Y"); $month++) {
            for ($week = 0; $date -> format("j") <= $date -> format("t") && $date -> format("n") == $month && $date -> format("Y") == $date2 -> format("Y"); $week++) {
                for ($day = $date -> format("N"); $day < 8 && $date -> format("n") == $month; $day++) {
                    $months[$this::MONTHS[$month]][$week][$day]["day"] = $date -> format("j");
                    $count = 0;

                    for ($event = 0; $event < count($events); $event++) {
                        $eventDate = new DateTime($events[$event] -> date);

                        if ($eventDate -> format("n-j") == $date -> format("n-j")) {
                            array_splice($events, $event, 0);
                            $count++;
                        }
                    }

                    $months[$this::MONTHS[$month]][$week][$day]["events"] = $count;
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
