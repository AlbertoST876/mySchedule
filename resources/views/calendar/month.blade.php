<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Calendario - Mes"])

    <body>
        @include("layouts.header")

        <main>
            @include("layouts.calendar.calendarAside")

            @include("layouts.calendar.calendarNav", ["type" => "month"])

            @dump($dates)
            @dump($dates2)
            @dump($weeks)

            <div>
                <table>
                    <thead>
                        <tr>
                            <th colspan="7">{{ $month }}</th>
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
                        @foreach ($weeks as $week)
                            <tr>                     
                                @foreach ($week as $day => $events)
                                    <td>
                                        <span>{{ $day }}</span>

                                        @foreach ($events as $event)
                                            <div>{{ $event -> name }}</div>
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
