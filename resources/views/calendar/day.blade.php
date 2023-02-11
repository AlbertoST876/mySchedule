<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Calendario - Dia"])

    <body>
        @include("layouts.header")

        <main>
            @include("layouts.calendar.calendarAside", ["type" => "day"])

            <div>
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">{{ $current }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $event -> time }}</td>

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
