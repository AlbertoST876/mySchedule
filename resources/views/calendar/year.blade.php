<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Alberto Sánchez Torreblanca">
        <link rel="icon" href="{{ asset('icon.png') }}">
        <title>Mi Agenda - Calendario - Año</title>
    </head>

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