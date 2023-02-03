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
                            <th><div>L</div><span>{{ $dates[0] }}</span></th>
                            <th><div>M</div><span>{{ $dates[1] }}</span></th>
                            <th><div>X</div><span>{{ $dates[2] }}</span></th>
                            <th><div>J</div><span>{{ $dates[3] }}</span></th>
                            <th><div>V</div><span>{{ $dates[4] }}</span></th>
                            <th><div>S</div><span>{{ $dates[5] }}</span></th>
                            <th><div>D</div><span>{{ $dates[6] }}</span></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($events as $time => $eventsDays)
                            <tr>
                                <td>{{ $time }}</td>

                                @foreach ($dates as $date)
                                    @if (array_key_exists($date, $eventsDays))
                                        <td>
                                            @foreach ($eventsDays as $eventsDay)
                                                @foreach ($eventsDay as $event)
                                                    <details>
                                                        <summary>{{ $event -> category }} - {{ $event -> name }}</summary>

                                                        {{ $event -> description }}
                                                    </details>
                                                @endforeach
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
