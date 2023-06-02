<?php

namespace App\Http\Controllers;

use DateTime;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Event;

class EventsController extends Controller
{
    const DATE_FORMAT = [
        "en" => "Y-m-d H:i",
        "es" => "d/m/Y H:i",
    ];

    public function __construct()
    {
        $this -> middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("events.index", [
            "prevEvents" => Event::leftJoin("categories", "events.category_id", "categories.id") -> leftJoin("category_user_colors", "categories.id", "category_user_colors.category_id") -> where("category_user_colors.user_id", Auth::id()) -> where ("events.user_id", Auth::id()) -> where("events.date", "<", DB::raw("NOW()")) -> select("events.id", "categories.name_" . app() -> getLocale() . " AS category", "events.name", "events.description", "events.color", "category_user_colors.color AS categoryColor", "events.date") -> orderByDesc("events.date") -> get(),
            "nextEvents" => Event::leftJoin("categories", "events.category_id", "categories.id") -> leftJoin("category_user_colors", "categories.id", "category_user_colors.category_id") -> where("category_user_colors.user_id", Auth::id()) -> where ("events.user_id", Auth::id()) -> where("events.date", ">=", DB::raw("NOW()")) -> select("events.id", "categories.name_" . app() -> getLocale() . " AS category", "events.name", "events.description", "events.color", "category_user_colors.color AS categoryColor", "events.date") -> orderBy("events.date") -> get(),
            "categories" => Category::select("id", "name_" . app() -> getLocale() . " AS name") -> get(),
            "dateFormat" => self::DATE_FORMAT[app() -> getLocale()],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            "category" => ["required", "integer", "between:1,4"],
            "name" => ["required", "string", "max:50"],
            "description" => ["string", "nullable", "max:255"],
            "color" => ["string", "nullable", "max:10"],
            "date" => ["required", "date"],
            "remember" => ["date", "nullable"],
        ]);

        Event::create([
            "category_id" => $request -> category,
            "user_id" => Auth::id(),
            "name" => $request -> name,
            "description" => $request -> description,
            "color" => $request -> color,
            "date" => $request -> date,
            "remember" => $request -> remember,
        ]);

        return redirect() -> route("events.index") -> with("status", __("messages.event_created"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view("events.show", [
            "event" => Event::leftJoin("categories", "events.category_id", "categories.id") -> leftJoin("category_user_colors", "categories.id", "category_user_colors.category_id") -> where("events.id", $request -> event) -> select("events.id", "categories.name_" . app() -> getLocale() . " AS category", "events.name", "events.description", "events.color", "category_user_colors.color AS categoryColor", "events.date") -> first(),
            "dateFormat" => self::DATE_FORMAT[app() -> getLocale()],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return view("events.edit", [
            "categories" => Category::select("id", "name_" . app() -> getLocale() . " AS name") -> get(),
            "event" => Event::find($request -> event),
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
            "remember" => ["date", "nullable"],
        ]);

        $event = Event::find($request -> event);
        $event -> category_id = $request -> category;
        $event -> name = $request -> name;
        $event -> description = $request -> description;
        $event -> color = $request -> color;
        $event -> date = $request -> date;

        if ($event -> remember != $request -> remember)
        {
            $event -> remember = $request -> remember;
            $event -> isRemembered = 0;
        }

        $event -> save();

        return redirect() -> route("events.index") -> with("status", __("messages.event_edited"));
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

        return redirect() -> route("events.index") -> with("status", __("messages.event_deleted"));
    }
}
