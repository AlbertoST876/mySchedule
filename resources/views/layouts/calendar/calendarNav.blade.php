<nav>
    <ul>
        <li><a href="{{ route("calendarDay") }}">Dia</a></li>
        <li><a href="{{ route("calendarWeek") }}">Semana</a></li>
        <li><a href="{{ route("calendarMonth") }}">Mes</a></li>
        <li><a href="{{ route("calendarYear") }}">Año</a></li>
    </ul>

    <form action="" method="get">
        @if ($type == "date")
            <input type="date" name="date" value="{{ date("Y-m-d") }}" min="{{ date("Y-m-d") }}" required>
        @elseif ($type == "week")
            <input type="week" name="date" value="{{ date("Y-\WW") }}" min="{{ date("Y-\WW") }}" required>
        @elseif ($type == "month")
            <input type="month" name="date" value="{{ date("Y-m") }}" min="{{ date("Y-m") }}" required>
        @elseif ($type == "year")
            <input type="number" name="date" value="{{ date("Y") }}" min="{{ date("Y") }}" required>
        @endif 

        <input type="submit" value="Consultar">
    </form>
</nav>