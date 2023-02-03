<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Calendario - Año"])

    <body>
        @include("layouts.header")

        <main>
            @include("layouts.calendar.calendarAside")

            @include("layouts.calendar.calendarNav", ["type" => "year"])

            @dump($months)

            <div>
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
                                    @foreach ($week as $day)
                                        <td>
                                            <span>{{ $day }}</span>

                                            <div></div>
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