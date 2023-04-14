<?php

namespace App\Http\Controllers;

use DateTime;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\Category;
use App\Models\Event;

class EventsController extends Controller
{
    private string $lang;
    private string $dateFormat;

    public function __construct()
    {
        $this -> middleware("auth");
        $this -> lang = app() -> getLocale();
        $this -> dateFormat = $this -> getDateFormat();
    }

    /**
     * Get date format depending on the language of the application.
     *
     * @return string
     */
    private function getDateFormat() {
        switch($this -> lang) {
            case "en":
                return "%Y-%m-%d %H:%i";
            case "es":
                return "%d/%m/%Y %H:%i";
            default:
                return "%Y-%m-%d %H:%i";
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Authenticatable  $user
     * @return \Illuminate\Http\Response
     */
    public function index(Authenticatable $user)
    {
        $categories = Category::all();
        $prevEvents = DB::table("events") -> leftJoin("categories", "events.category_id", "categories.id") -> leftJoin("category_user_colors", "categories.id", "category_user_colors.category_id") -> where("category_user_colors.user_id", $user -> id) -> where("events.date", "<", DB::raw("NOW()")) -> select("events.id", "categories.name_" . $this -> lang . " AS category", "events.name", "events.description", "events.color", "category_user_colors.color AS categoryColor", DB::raw("DATE_FORMAT(events.date, '" . $this -> dateFormat . "') AS date")) -> orderBy("events.date", "DESC") -> get();
        $nextEvents = DB::table("events") -> leftJoin("categories", "events.category_id", "categories.id") -> leftJoin("category_user_colors", "categories.id", "category_user_colors.category_id") -> where("category_user_colors.user_id", $user -> id) -> where("events.date", ">=", DB::raw("NOW()")) -> select("events.id", "categories.name_" . $this -> lang . " AS category", "events.name", "events.description", "events.color", "category_user_colors.color AS categoryColor", DB::raw("DATE_FORMAT(events.date, '" . $this -> dateFormat . "') AS date")) -> orderBy("events.date") -> get();

        return view("events.index", [
            "categories" => $categories,
            "prevEvents" => $prevEvents,
            "nextEvents" => $nextEvents
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

        return redirect() -> route("events") -> with("status", __("messages.event_created"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $event = DB::table("events") -> leftJoin("categories", "events.category_id", "categories.id") -> leftJoin("category_user_colors", "categories.id", "category_user_colors.category_id") -> where("events.id", $request -> event) -> select("events.id", "categories.name_" . $this -> lang . " AS category", "events.name", "events.description", "events.color", "category_user_colors.color AS categoryColor", DB::raw("DATE_FORMAT(events.date, '" . $this -> dateFormat . "') AS date")) -> first();

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
        $categories = Category::select("id", "name_" . $this -> lang . " AS name") -> get();
        $event = Event::find($request -> event);

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

        return redirect() -> route("events") -> with("status", __("messages.event_edited"));
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

        return redirect() -> route("events") -> with("status", __("messages.event_deleted"));
    }
}
