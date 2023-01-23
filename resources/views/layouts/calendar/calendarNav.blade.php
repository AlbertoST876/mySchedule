<nav>
    <ul>
        <li><a href="{{ route("calendar.day") }}">Dia</a></li>
        <li><a href="{{ route("calendar.week") }}">Semana</a></li>
        <li><a href="{{ route("calendar.month") }}">Mes</a></li>
        <li><a href="{{ route("calendar.year") }}">Año</a></li>
    </ul>

    <form action="" method="get">
        @if ($type == "date")
            <input type="date" name="date" value="{{ isset($_GET["date"]) ? $_GET["date"] : date("Y-m-d") }}" min="2023-01-01" required>
        @elseif ($type == "week")
            <input type="week" name="date" value="{{ isset($_GET["date"]) ? $_GET["date"] : date("Y-\WW") }}" min="2023-W01" required>
        @elseif ($type == "month")
            <input type="month" name="date" value="{{ isset($_GET["date"]) ? $_GET["date"] : date("Y-m") }}" min="2023-01" required>
        @elseif ($type == "year")
            <input type="number" name="date" value="{{ isset($_GET["date"]) ? $_GET["date"] : date("Y") }}" min="2023" required>
        @endif

        <input type="submit" value="Consultar">
    </form>
</nav>