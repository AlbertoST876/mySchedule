<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Calendario - Dia"])

    <body>
        @include("layouts.header")

        <main>
            @include("layouts.calendar.calendarAside")

            @include("layouts.calendar.calendarNav", ["type" => "date"])

            <div>
                <table>
                    <thead>
                        <tr>
                            <th colspan="4">{{ $day }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $event -> dateESP }}</td>
                                <td>{{ $event -> category }}</td>
                                <td>{{ $event -> name }}</td>
                                <td>{{ $event -> description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>