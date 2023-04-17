<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alberto Sánchez Torreblanca">
    @vite(["resources/js/app.js", "resources/css/app.css"])
    <script src="https://cdn.jsdelivr.net/npm/nice-select2/dist/js/nice-select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nice-select2/dist/css/nice-select2.min.css">
    <link rel="icon" href="{{ asset("icon.svg") }}">
    <title>@lang("messages.title") - {{ $title }}</title>

    @auth
        @php date_default_timezone_set(session() -> get("timeZone")) @endphp
    @endauth
</head>
