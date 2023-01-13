<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Calendario - Semana"])

    <body>
        @include("layouts.header")

        <aside>
            <nav>
                <ul>
                    <li><a href="{{ route("calendarDay") }}">Dia</a></li>
                    <li><a href="{{ route("calendarWeek") }}">Semana</a></li>
                    <li><a href="{{ route("calendarMonth") }}">Mes</a></li>
                    <li><a href="{{ route("calendarYear") }}">Año</a></li>
                </ul>
            </nav>
        </aside>

        <main>
            
        </main>
    </body>
</html>