<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\Event;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Authenticatable $user)
    {
        // $nextEvents = DB::select("SELECT * FROM events WHERE user_id = ? AND date > NOW() ORDER BY date ASC", [$user -> id]);
        // $prevEvents = DB::select("SELECT * FROM events WHERE user_id = ? AND date < NOW() ORDER BY date DESC", [$user -> id]);

        $categories = DB::table("categories") -> get();
        $eventsDB = DB::select("SELECT * FROM events WHERE user_id = ? ORDER BY date ASC", [$user -> id]);

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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            "type" => ["required", "integer", "between:1,4"],
            "name" => ["required", "string", "max:50"],
            "description" => ["string", "max:255"],
            "datetime" => ["required", "datetime"]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("events.show", $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("events.edit", $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
