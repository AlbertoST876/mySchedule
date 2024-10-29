<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public const DATE_FORMAT = [
        "en" => "Y-m-d",
        "es" => "d/m/Y",
    ];

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
            "dateFormat" => self::DATE_FORMAT[app() -> getLocale()],
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
            "dateFormat" => self::DATE_FORMAT[app() -> getLocale()],
        ]);
    }
}
