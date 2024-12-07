<!DOCTYPE html>

<html lang="{{ app() -> getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config("app.name") }} - @lang("app.rememberEmail")</title>
    </head>

    <body>
        <main>
            <h1>{{ $name }}</h1>
            <p>{{ $description }}</p>
            <p>@lang("app.rememberMessage") <span>{{ $date }}</span></p>
        </main>
    </body>
</html>
