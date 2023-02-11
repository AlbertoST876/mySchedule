<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Calendario - Año"])

    <body>
        @include("layouts.header")

        <main>
            @include("layouts.calendar.calendarAside", ["type" => "year"])

            <div>
                <div>{{ $current }}</div>

                @foreach ($months as $month)
                    <table>
                        <thead>
                            <tr>
                                <th colspan="8">
                                    <form action="{{ route("calendar.month") }}" method="get">
                                        <input type="hidden" name="date" value="{{ $month["date"] }}">
                                        <input type="submit" value="{{ $month["name"] }}">
                                    </form>
                                </th>
                            </tr>

                            <tr>
                                <th>Nº</th>
                                <th>L</th>
                                <th>M</th>
                                <th>X</th>
                                <th>J</th>
                                <th>V</th>
                                <th>S</th>
                                <th>D</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($month["weeks"] as $key => $week)
                                <tr>
                                    <td>
                                        <form action="{{ route("calendar.week") }}" method="get">
                                            <input type="hidden" name="date" value="{{ $week["date"] }}">
                                            <input type="submit" value="{{ $week["num"] }}">
                                        </form>
                                    </td>

                                    @if ($key == 0 && count($week["days"]) < 7)
                                        <td colspan="{{ 7 - count($week["days"]) }}"></td>
                                    @endif

                                    @foreach ($week["days"] as $day)
                                        <td>
                                            <form action="{{ route("calendar.day") }}" method="get">
                                                <input type="hidden" name="date" value="{{ $day["date"] }}">
                                                <input type="submit" value="{{ $day["num"] }}">
                                            </form>

                                            @if ($day["events"] > 0)
                                                <div>{{ $day["events"] }}</div>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>
        </main>
    </body>
</html>
