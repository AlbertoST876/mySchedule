<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public const DATE_FORMAT = [
        "en" => "Y-m-d",
        "es" => "d/m/Y",
    ];

    public const DATETIME_FORMAT = [
        "en" => "Y-m-d H:i",
        "es" => "d/m/Y H:i",
    ];

    public static function getDateFormatted(string $date): string {
        return date_format(date_create($date), self::getDateFormat());
    }

    public static function getDateFormat(): string {
        return self::DATE_FORMAT[app() -> getLocale()];
    }

    public static function getDateTimeFormat(): string {
        return self::DATETIME_FORMAT[app() -> getLocale()];
    }
}
