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
                            <th>{{ $current }}</th>
                            <th><div>L</div><span>{{ $days[1]["num"] }}</span></th>
                            <th><div>M</div><span>{{ $days[2]["num"] }}</span></th>
                            <th><div>X</div><span>{{ $days[3]["num"] }}</span></th>
                            <th><div>J</div><span>{{ $days[4]["num"] }}</span></th>
                            <th><div>V</div><span>{{ $days[5]["num"] }}</span></th>
                            <th><div>S</div><span>{{ $days[6]["num"] }}</span></th>
                            <th><div>D</div><span>{{ $days[7]["num"] }}</span></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($times as $time => $eventsDays)
                            <tr>
                                <td>{{ $time }}</td>

                                @foreach ($days as $day)
                                    @if (array_key_exists($day, $eventsDays))
                                        <td>
                                            @foreach ($eventsDays[$day] as $event)
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
