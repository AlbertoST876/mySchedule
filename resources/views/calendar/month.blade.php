<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Calendario - Mes"])

    <body>
        @include("layouts.header")

        <main>
            @include("layouts.calendar.calendarAside", ["type" => "month"])

            <div>
                <table>
                    <thead>
                        <tr>
                            <th colspan="8">{{ $current }}</th>
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
                        @foreach ($weeks as $key => $week)
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

                                        @foreach ($day["events"] as $event)
                                            <div>
                                                <details>
                                                    <summary>{{ $event -> category }} - {{ $event -> name }}</summary>

                                                    {{ $event -> description }}
                                                </details>
                                            </div>
                                        @endforeach
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>
