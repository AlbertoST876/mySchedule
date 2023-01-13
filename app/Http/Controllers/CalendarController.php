<?php

namespace App\Http\Controllers;

class CalendarController extends Controller
{
    public function day() {
        return view("calendar.day");
    }

    public function week() {
        return view("calendar.week");
    }

    public function month() {
        return view("calendar.month");
    }

    public function year() {
        return view("calendar.year");
    }
}