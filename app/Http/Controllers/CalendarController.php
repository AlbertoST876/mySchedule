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
        $day = $date -> format("d") . " de " . $this::MONTHS[$date -> format("m")] . " de " . $date -> format("Y");

        $events = DB::select("SELECT events.id, categories.name AS category, events.name, events.description, DATE_FORMAT(events.date, '%H:%i') as hour FROM events LEFT JOIN categories ON events.category_id = categories.id WHERE events.user_id = ? AND events.date LIKE '" . $request -> date . "%' ORDER BY events.date ASC", [$user -> id]);

        return view("calendar.day", [
            "events" => $events,
            "day" => $day
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

        $eventsDB = DB::select("SELECT events.id, categories.name AS category, events.name, events.description, events.date FROM events LEFT JOIN categories ON events.category_id = categories.id WHERE events.user_id = ? AND events.date BETWEEN '" . $date -> format("Y-m-d") . " 00:00:00' AND '" . $date2 -> format("Y-m-d") . " 23:59:59' ORDER BY events.date ASC", [$user -> id]);

        $month =  $this::MONTHS[$date -> format("m")];
        $month2 =  $this::MONTHS[$date2 -> format("m")];
        $year = $date -> format("Y");
        $year2 = $date2 -> format("Y");

        if ($month != $month2 && $year != $year2) $month .= " - " . $month2 . " de " . $year . " - " . $year2;
        if ($month != $month2 && $year == $year2) $month .= " - " . $month2 . " de " . $year;
        if ($month == $month2 && $year == $year2) $month .= " de " . $year;

        $dates = [];

        for ($i = 0; $i < 7; $i++) {
            $dates[] = $date -> format("d");
            $date -> add(new DateInterval("P1D"));
        }

        $events = [];

        foreach ($eventsDB as $event) {
            $eventDate = new DateTime($event -> date);
            $events[$eventDate -> format("H:i")][$eventDate -> format("d")][] = $event;
        }

        ksort($events);

        return view("calendar.week", [
            "events" => $events,
            "dates" => $dates,
            "month" => $month
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

        $month = $this::MONTHS[$date -> format("m")] . " de " . $date -> format("Y");

        $eventsDB = DB::select("SELECT events.id, categories.name AS category, events.name, events.description, events.date FROM events LEFT JOIN categories ON events.category_id = categories.id WHERE events.user_id = ? AND events.date BETWEEN '" . $request -> date . "-01 00:00:00' AND '" . $request -> date . "-" . $date -> format("t") . " 23:59:59' ORDER BY events.date ASC", [$user -> id]);
        $events = [];

        foreach ($eventsDB as $event) {
            $eventDate = new DateTime($event -> date);
            $events[$eventDate -> format("j")][] = $event;
        }

        $date -> format("W") == 52 ? $date -> setISODate($date -> format("Y") - 1, $date -> format("W")) : $date -> setISODate($date -> format("Y"), $date -> format("W"));

        $dates = [$date -> format("Y-m-d W"), $date2 -> format("Y-m-d W")];

        $weeks = [];

        for ($week = (int)$date -> format("W"); $week <= $date2 -> format("W") || $date2 -> format("W") == 01 || $week == 52; $week++) {
            if ($date -> format("Y") != $date2 -> format("Y") && $week == 52) $week = 0;

            for ($i = 0; $i < 7; $i++) {
                $weeks[$week][$date -> format("j")] = [];

                $date -> add(new DateInterval("P1D"));
            }

            if ($date -> format("W") == 01 && $date2 -> format("W") == 01) {
                for ($i = 0; $i < 7; $i++) {
                    $weeks[53][$date -> format("j")] = [];
    
                    $date -> add(new DateInterval("P1D"));
                }

                $date2 -> sub(new DateInterval("P1W"));
            }
        }

        $dates2 = [$date -> format("Y-m-d W"), $date2 -> format("Y-m-d W")];

        return view("calendar.month", [
            "events" => $events,
            "weeks" => $weeks,
            "month" => $month,
            "dates" => $dates,
            "dates2" => $dates2,
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

        return view("calendar.year");
    }
}
