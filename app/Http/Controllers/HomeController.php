<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Return view about
     *
     * @return Response
     */
    public function about()
    {
        return view("footer.about");
    }

    /**
     * Return view license
     *
     * @return Response
     */
    public function license()
    {
        return view("footer.license", [
            "date" => self::getDateFormatted("2024-12-07"),
        ]);
    }

    /**
     * Return view license
     *
     * @return Response
     */
    public function privacyPolicy()
    {
        return view("footer.privacyPolicy", [
            "date" => self::getDateFormatted("2024-12-07"),
        ]);
    }
}
