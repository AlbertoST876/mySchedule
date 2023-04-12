<?php

namespace App\Http\Controllers;

use DateTime;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\Event;

class EventsController extends Controller
{
    public function __construct()
    {
        $this -> middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Authenticatable  $user
     * @return \Illuminate\Http\Response
     */
    public function index(Authenticatable $user)
    {
        $categories = DB::table("categories") -> get();
        $eventsDB = DB::table("events") -> leftJoin("categories", "events.category_id", "categories.id") -> leftJoin("category_user_colors", "categories.id", "category_user_colors.category_id") -> where("category_user_colors.user_id", $user -> id) -> select("events.id", "categories.name AS category", "events.name", "events.description", "events.color", "category_user_colors.color AS categoryColor", "events.date") -> orderBy("events.date") -> get();

        $events = [
            "nextEvents" => [],
            "prevEvents" => []
        ];

        foreach ($eventsDB as $eventDB) {
            $eventDate = new DateTime($eventDB -> date);

            if ($eventDB -> date > date("Y-m-d H:i:s")) {
                $eventDB -> date = $eventDate -> format("d/m/Y H:i");
                $events["nextEvents"][] = $eventDB;
            } else {
                $eventDB -> date = $eventDate -> format("d/m/Y H:i");
                $events["prevEvents"][] = $eventDB;
            }
        }

        krsort($events["prevEvents"]);

        return view("events.index", [
            "categories" => $categories,
            "events" => $events
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\Authenticatable  $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Authenticatable $user)
    {
        $request -> validate([
            "category" => ["required", "integer", "between:1,4"],
            "name" => ["required", "string", "max:50"],
            "description" => ["string", "nullable", "max:255"],
            "color" => ["string", "nullable", "max:10"],
            "date" => ["required", "date"],
            "remember" => ["date", "nullable"]
        ]);

        Event::create([
            "category_id" => $request -> category,
            "user_id" => $user -> id,
            "name" => $request -> name,
            "description" => $request -> description,
            "color" => $request -> color,
            "date" => $request -> date,
            "remember" => $request -> remember
        ]);

        return redirect() -> intended("events") -> with("status", "El evento se creó correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $event = DB::table("events") -> leftJoin("categories", "events.category_id", "categories.id") -> leftJoin("category_user_colors", "categories.id", "category_user_colors.category_id") -> where("events.id", $request -> event) -> select("events.id", "categories.name AS category", "events.name", "events.description", "events.color", "category_user_colors.color AS categoryColor", DB::raw("DATE_FORMAT(events.date, '%d/%m/%Y %H:%i') AS date")) -> first();

        return view("events.show", ["event" => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $categories = DB::table("categories") -> get();
        $event = DB::table("events") -> where("id", $request -> event) -> select("id", "category_id", "name", "description", "color", DB::raw("DATE_FORMAT(date, '%Y-%m-%d\T%H:%i') AS date"), DB::raw("DATE_FORMAT(remember, '%Y-%m-%d\T%H:%i') AS remember")) -> first();

        return view("events.edit", [
            "categories" => $categories,
            "event" => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request -> validate([
            "category" => ["required", "integer", "between:1,4"],
            "name" => ["required", "string", "max:50"],
            "description" => ["string", "nullable", "max:255"],
            "color" => ["string", "nullable", "max:10"],
            "date" => ["required", "date"],
            "remember" => ["date", "nullable"]
        ]);

        $event = Event::find($request -> event);
        $event -> category_id = $request -> category;
        $event -> name = $request -> name;
        $event -> description = $request -> description;
        $event -> color = $request -> color;
        $event -> date = $request -> date;
        $event -> remember = $request -> remember;
        $event -> isRemembered = 0;
        $event -> save();

        return redirect() -> intended("events") -> with("status", "El evento se editó correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Event::destroy($request -> event);

        return redirect() -> intended("events") -> with("status", "El evento se eliminó correctamente");
    }
}
