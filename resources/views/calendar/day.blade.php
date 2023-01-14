<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Calendario - Dia"])

    <body>
        @include("layouts.header")

        <main>
            @include("layouts.calendar.calendarAside")

            @include("layouts.calendar.calendarNav", ["type" => "date"])

            <div>

            </div>
        </main>
    </body>
</html>