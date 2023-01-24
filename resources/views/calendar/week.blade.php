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
                            <th>{{ $month }}</th>
                            <th>L<br><span>{{ $dates[0] }}</span></th>
                            <th>M<br><span>{{ $dates[1] }}</span></th>
                            <th>X<br><span>{{ $dates[2] }}</span></th>
                            <th>J<br><span>{{ $dates[3] }}</span></th>
                            <th>V<br><span>{{ $dates[4] }}</span></th>
                            <th>S<br><span>{{ $dates[5] }}</span></th>
                            <th>D<br><span>{{ $dates[6] }}</span></th>
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
                                                    <div>{{ $event -> name }}</div>
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