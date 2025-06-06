<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="author" content="Alberto Sánchez Torreblanca">
    <meta name="copyright" content="Alberto Sánchez Torreblanca">
    <meta name="robots" content="noindex,nofollow">
    @vite(["resources/js/app.js", "resources/css/app.css"])
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <link rel="icon" href="{{ asset("icon.svg") }}">
    <title>{{ config("app.name") }} - {{ $title }}</title>

    @auth
        @php date_default_timezone_set(Auth::user() -> timezone -> name) @endphp
    @endauth
</head>
