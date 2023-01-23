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
                            <th>L<br><span>{{ $days[0] }}</span></th>
                            <th>M<br><span>{{ $days[1] }}</span></th>
                            <th>X<br><span>{{ $days[2] }}</span></th>
                            <th>J<br><span>{{ $days[3] }}</span></th>
                            <th>V<br><span>{{ $days[4] }}</span></th>
                            <th>S<br><span>{{ $days[5] }}</span></th>
                            <th>D<br><span>{{ $days[6] }}</span></th>
                        </tr>
                    </thead>

                    @for ($i = 0; $i < 7; $i++)
                        @foreach ($events[$i] as $event)
                            <tr>
                                <td>{{ $event -> dateESP }}</td>
                                <td>{{ $event -> category }}</td>
                                <td>{{ $event -> name }}</td>
                                <td>{{ $event -> description }}</td>
                            </tr>
                        @endforeach
                    @endfor
                </table>
            </div>
        </main>
    </body>
</html>