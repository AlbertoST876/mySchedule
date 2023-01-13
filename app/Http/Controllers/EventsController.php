<?php

namespace App\Http\Controllers;

class EventsController extends Controller
{
    public function index() {
        return view("events.index");
    }

    public function show() {
        return view("events.show");
    }

    public function edit() {
        return view("events.edit");
    }
}