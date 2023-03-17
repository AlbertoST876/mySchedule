<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alberto Sánchez Torreblanca">
    <link rel="icon" href="{{ asset("icon.svg") }}">
    <title>MySchedule - {{ $title }}</title>

    @if ($_SERVER["REQUEST_URI"] == "/events" || $_SERVER["REQUEST_URI"] == "/events/edit")
        @vite(["resources/css/app.css", "resources/js/app.js", "resources/js/formFieldsControl.js"])
    @else
        @vite(["resources/css/app.css", "resources/js/app.js"])
    @endif
</head>
