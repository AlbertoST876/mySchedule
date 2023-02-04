<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Calendario - Año"])

    <body>
        @include("layouts.header")

        <main>
            @include("layouts.calendar.calendarAside")

            @include("layouts.calendar.calendarNav", ["type" => "year"])

            <div>
                <div>{{ $current }}</div>

                @foreach ($months as $name => $month)
                    <table>
                        <thead>
                            <tr>
                                <th colspan="7">{{ $name }}</th>
                            </tr>

                            <tr>
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
                            @foreach ($month as $key => $week)
                                <tr>
                                    @if ($key == 0 && count($month[0]) < 7)
                                        <td colspan="{{ 7 - count($month[0]) }}"></td>
                                    @endif

                                    @foreach ($week as $day)
                                        <td>
                                            <span>{{ $day["day"] }}</span>

                                            @if ($day["events"] != 0)
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
