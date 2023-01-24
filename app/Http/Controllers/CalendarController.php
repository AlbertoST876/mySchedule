<?php

namespace App\Http\Controllers;

use DateTime;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Authenticatable;

class CalendarController extends Controller
{
    /**
     * Display all events in one day.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Authenticatable  $user
     * @return \Illuminate\Http\Response
     */
    public function day(Request $request, Authenticatable $user)
    {
        if (is_null($request -> date)) $request -> date = date("Y-m-d");

        $events = DB::select("SELECT events.id, categories.name AS category, events.name, events.description, DATE_FORMAT(events.date, '%H:%i') as dateESP FROM events LEFT JOIN categories ON events.category_id = categories.id WHERE events.user_id = ? AND events.date LIKE '" . $request -> date . "%' ORDER BY events.date ASC", [$user -> id]);

        return view("calendar.day", [
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
        if (is_null($request -> date)) $request -> date = date("Y-\WW");

        $months = [
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

        $week = explode("-W", $request -> date);

        $date = new DateTime();
        $date -> setISODate($week[0], $week[1]);
        $date2 = new DateTime();
        $date2 -> setISODate($week[0], $week[1]);
        $date2 -> add(new DateInterval("P6D"));
        
        $eventsDB = DB::select("SELECT events.id, categories.name AS category, events.name, events.description, events.date FROM events LEFT JOIN categories ON events.category_id = categories.id WHERE events.user_id = ? AND events.date BETWEEN '" . $date -> format("Y-m-d") . " 00:00:00' AND '" . $date2 -> format("Y-m-d") . " 23:59:59' ORDER BY events.date ASC", [$user -> id]);
        $dates = [];

        $month = $months[$date -> format("m")];
        
        for ($i = 0; $i < 7; $i++) {
            $dates[] = $date -> format("d");
            $date -> add(new DateInterval("P1D"));
        }

        $month2 = $months[$date -> format("m")];

        if ($month != $month2) $month .= " - " . $month2;

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
     * Display all events in one month.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Authenticatable  $user
     * @return \Illuminate\Http\Response
     */
    public function month(Request $request, Authenticatable $user)
    {
        return view("calendar.month");
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
        return view("calendar.year");
    }
}
