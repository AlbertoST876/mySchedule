<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Event;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Authenticatable  $user
     * @return \Illuminate\Http\Response
     */
    public function index(Authenticatable $user)
    {
        $categories = DB::table("categories") -> get();
        $eventsDB = DB::select("SELECT events.id, categories.name AS category, events.name, events.description, events.date FROM events LEFT JOIN categories ON events.category_id = categories.id WHERE events.user_id = ? ORDER BY date ASC", [$user -> id]);

        $events = [
            "nextEvents" => [],
            "prevEvents" => []
        ];

        foreach ($eventsDB as $eventDB) {
            if ($eventDB -> date > date("Y-m-d H:i:s")) {
                $events["nextEvents"][] = $eventDB;
            } else {
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $validator = Validator::make($request -> all(), [
            "type" => ["required", "integer", "between:1,4"],
            "name" => ["required", "string", "max:50"],
            "description" => ["string", "max:255"],
            "datetime" => ["required", "date"]
        ]);

        if ($validator -> fails()) {
            throw ValidationException::withMessages(["datetime" => "Los datos introducidos no son validos"]);
        }

        Event::create([
            "category_id" => $request -> type,
            "user_id" => $user -> id,
            "name" => $request -> name,
            "description" => $request -> description,
            "date" => $request -> datetime
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
        $event = Event::find($request -> event);

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
        $event = Event::find($request -> event);

        return view("events.edit", ["event" => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
