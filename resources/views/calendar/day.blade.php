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
                            <th colspan="2">{{ $day }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $event -> hour }}</td>

                                <td>
                                    <details>
                                        <summary>{{ $event -> category }} - {{ $event -> name }}</summary>

                                        {{ $event -> description }}
                                    </details>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>
