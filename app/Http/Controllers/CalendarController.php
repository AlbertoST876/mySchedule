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

        $week = explode("-W", $request -> date);

        $date = new DateTime();
        $date -> setISODate($week[0], $week[1]);
        
        $events = [];
        $days = [];
        
        for ($i = 0; $i < 7; $i++) {
            $days[] = $date -> format("d");
            $events[] = DB::select("SELECT events.id, categories.name AS category, events.name, events.description, DATE_FORMAT(events.date, '%H:%i') as dateESP FROM events LEFT JOIN categories ON events.category_id = categories.id WHERE events.user_id = ? AND events.date LIKE '" . $date -> format("Y-m-d") . "%' ORDER BY events.date ASC", [$user -> id]);
            
            $date -> add(new DateInterval("P1D"));
        }

        return view("calendar.week", [
            "events" => $events,
            "days" => $days
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
