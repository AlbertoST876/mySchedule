<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Calendario - Mes"])

    <body>
        @include("layouts.header")

        <main>
            @include("layouts.calendar.calendarAside")

            @include("layouts.calendar.calendarNav", ["type" => "month"])

            <div>
                <table>
                    <thead>
                        <tr>
                            <th colspan="7">{{ $current }}</th>
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
                        @foreach ($weeks as $key => $week)
                            <tr>
                                @if ($key == 0 && count($week) < 7)
                                    <td colspan="{{ 7 - count($week) }}"></td>
                                @endif

                                @foreach ($week as $day)
                                    <td>
                                        <span>{{ $day["num"] }}</span>

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
