<?php

namespace App\Http\Controllers;

use DateTime;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CategoryUserColor;
use App\Models\Category;
use App\Models\Event;

class CalendarController extends Controller
{
    private array $months;

    public function __construct()
    {
        $this -> middleware("auth");

        $this -> months = [
            "01" => __("messages.january"),
            "02" => __("messages.february"),
            "03" => __("messages.march"),
            "04" => __("messages.april"),
            "05" => __("messages.may"),
            "06" => __("messages.june"),
            "07" => __("messages.jule"),
            "08" => __("messages.august"),
            "09" => __("messages.september"),
            "10" => __("messages.october"),
            "11" => __("messages.november"),
            "12" => __("messages.december"),
        ];
    }

    /**
     * Redirect from "/calendar" to "/calendar/month".
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect() -> route("calendar.month");
    }

    /**
     * Display all events in one day.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function day(Request $request)
    {
        if (!isset($request -> date)) {
            $request -> date = date("Y-m-d");
        }

        $date = new DateTime($request -> date);
        $current = $date -> format("j") . " " . $this -> months[$date -> format("m")] . " " . $date -> format("Y");

        $events = Event::leftJoin("categories", "events.category_id", "categories.id") -> leftJoin("category_user_colors", "categories.id", "category_user_colors.category_id") -> where("category_user_colors.user_id", Auth::id()) -> where("events.user_id", Auth::id()) -> where(DB::raw("DATE(events.date)"), $request -> date) -> select("events.id", "categories.name_" . app() -> getLocale() . " AS category", "events.name", "events.description", "events.color", "category_user_colors.color AS categoryColor", "events.date") -> orderBy("events.date") -> get();
        $times = [];

        foreach ($events as $event) {
            $times[$event -> date -> format("H:i")][] = $event;
        }

        return view("calendar.day", [
            "current" => $current,
            "times" => $times,
        ]);
    }

    /**
     * Display all events in one week.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function week(Request $request)
    {
        if (!isset($request -> date)) {
            $request -> date = date("Y-\WW");
        }

        $week = explode("-W", $request -> date);

        $date = new DateTime();
        $date -> setISODate($week[0], $week[1]);
        $date2 = new DateTime();
        $date2 -> setISODate($week[0], $week[1]);
        $date2 -> add(new DateInterval("P6D"));

        $month = $this -> months[$date -> format("m")];
        $month2 = $this -> months[$date2 -> format("m")];
        $year = $date -> format("Y");
        $year2 = $date2 -> format("Y");

        if ($month != $month2 && $year != $year2) $month .= " - " . $month2 . " " . $year . " - " . $year2;
        if ($month != $month2 && $year == $year2) $month .= " - " . $month2 . " " . $year;
        if ($month == $month2 && $year == $year2) $month .= " " . $year;

        $events = Event::leftJoin("categories", "events.category_id", "categories.id") -> leftJoin("category_user_colors", "categories.id", "category_user_colors.category_id") -> where("category_user_colors.user_id", Auth::id()) -> where("events.user_id", Auth::id()) -> whereBetween(DB::raw("DATE(events.date)"), [$date -> format("Y-m-d"), $date2 -> format("Y-m-d")]) -> select("events.id", "categories.name_" . app() -> getLocale() . " AS category", "events.name", "events.description", "events.color", "category_user_colors.color AS categoryColor", "events.date") -> orderBy("events.date") -> get();
        $times = [];

        foreach ($events as $event) {
            $times[$event -> date -> format("H:i")][$event -> date -> format("j")][] = $event;
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
     * @return \Illuminate\Http\Response
     */
    public function month(Request $request)
    {
        if (!isset($request -> date)) {
            $request -> date = date("Y-m");
        }

        $date = new DateTime($request -> date . "-01");
        $date2 = new DateTime($request -> date . "-" . $date -> format("t"));

        $current = $this -> months[$date -> format("m")] . " " . $date -> format("Y");

        $events = Event::leftJoin("categories", "events.category_id", "categories.id") -> leftJoin("category_user_colors", "categories.id", "category_user_colors.category_id") -> where("category_user_colors.user_id", Auth::id()) -> where("events.user_id", Auth::id()) -> whereBetween(DB::raw("DATE(events.date)"), [$date -> format("Y-m-d"), $date2 -> format("Y-m-d")]) -> select("events.id", "categories.name_" . app() -> getLocale() . " AS category", "events.name", "events.description", "events.color", "category_user_colors.color AS categoryColor", "events.date") -> orderBy("events.date") -> get();
        $weeks = [];

        for ($week = 0; $date -> format("m") == $date2 -> format("m"); $week++) {
            $weeks[$week]["num"] = $date -> format("W");
            $weeks[$week]["date"] = $date -> format("o-\WW");

            for ($day = $date -> format("N"); $day < 8 && $date -> format("m") == $date2 -> format("m"); $day++) {
                $weeks[$week]["days"][$day]["num"] = $date -> format("j");
                $weeks[$week]["days"][$day]["date"] = $date -> format("Y-m-d");
                $weeks[$week]["days"][$day]["events"] = [];

                for ($i = 0; $i < count($events); $i++) {
                    if ($events[$i] -> date -> format("j") == $date -> format("j")) {
                        $weeks[$week]["days"][$day]["events"][] = $events[$i];
                        unset($events[$i]);
                    }
                }

                $eventsTmp = [];

                foreach ($events as $event) {
                    if (!is_null($event)) {
                        $eventsTmp[] = $event;
                    }
                }

                $events = $eventsTmp;

                $date -> add(new DateInterval("P1D"));
            }
        }

        return view("calendar.month", [
            "current" => $current,
            "weeks" => $weeks,
        ]);
    }

    /**
     * Display all events in one year.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function year(Request $request)
    {
        if (!isset($request -> date)) {
            $request -> date = date("Y");
        }

        $date = new DateTime($request -> date . "-01-01");
        $date2 = new DateTime($request -> date . "-12-31");

        $current = $date -> format("Y");

        $events = Event::where("user_id", Auth::id()) -> whereBetween(DB::raw("DATE(date)"), [$date -> format("Y-m-d"), $date2 -> format("Y-m-d")]) -> select("date") -> orderBy("date") -> get();
        $months = [];

        for ($month = 1; $date -> format("Y") == $date2 -> format("Y"); $month++) {
            $months[$month]["name"] = $this -> months[$date -> format("m")];
            $months[$month]["date"] = $date -> format("Y-m");

            for ($week = 0; $date -> format("n") == $month && $date -> format("Y") == $date2 -> format("Y"); $week++) {
                $months[$month]["weeks"][$week]["num"] = $date -> format("W");
                $months[$month]["weeks"][$week]["date"] = $date -> format("o-\WW");

                for ($day = $date -> format("N"); $day < 8 && $date -> format("n") == $month; $day++) {
                    $months[$month]["weeks"][$week]["days"][$day]["num"] = $date -> format("j");
                    $months[$month]["weeks"][$week]["days"][$day]["date"] = $date -> format("Y-m-d");
                    $color = "";
                    $count = 0;

                    for ($i = 0; $i < count($events); $i++) {
                        if ($events[$i] -> date -> format("n-j") == $date -> format("n-j")) {
                            unset($events[$i]);
                            $count++;
                        }
                    }

                    $eventsTmp = [];

                    foreach ($events as $event) {
                        if (!is_null($event)) {
                            $eventsTmp[] = $event;
                        }
                    }

                    $events = $eventsTmp;

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
            "months" => $months,
        ]);
    }
}
