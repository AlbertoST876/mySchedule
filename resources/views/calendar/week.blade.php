<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Calendario - Semana"])

    <body>
        @include("layouts.header")

        <main>
            @include("layouts.calendar.calendarAside")

            @include("layouts.calendar.calendarNav", ["type" => "week"])

            <div>
                <table>
                    <thead>
                        <tr>
                            <th rowspan="2">{{ $current }}</th>
                            <th>L</th>
                            <th>M</th>
                            <th>X</th>
                            <th>J</th>
                            <th>V</th>
                            <th>S</th>
                            <th>D</th>
                        </tr>

                        <tr>
                            @foreach ($days as $day)
                                <th>
                                    <form action="{{ route("calendar.day") }}" method="get">
                                        <input type="hidden" name="date" value="{{ $day["date"] }}">
                                        <input type="submit" value="{{ $day["num"] }}">
                                    </form>
                                </th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($times as $time => $eventsDays)
                            <tr>
                                <td>{{ $time }}</td>

                                @foreach ($days as $day)
                                    @if (array_key_exists($day["num"], $eventsDays))
                                        <td>
                                            @foreach ($eventsDays[$day["num"]] as $event)
                                                <details>
                                                    <summary>{{ $event -> category }} - {{ $event -> name }}</summary>

                                                    {{ $event -> description }}
                                                </details>
                                            @endforeach
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>
