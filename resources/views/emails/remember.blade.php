<!DOCTYPE html>

<html lang="{{ app() -> getLocale() }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@lang("messages.appName") - @lang("messages.rememberEmail")</title>
    </head>

    <body>
        <main>
            <h1>{{ $name }}</h1>
            <p>{{ $description }}</p>
            <p>@lang("messages.rememberMessage") <span>{{ $date }}</span></p>
        </main>
    </body>
</html>
