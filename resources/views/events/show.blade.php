<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Eventos - Visor"])

    <body>
        @include("layouts.header")

        <main>
            <h1>{{ $event -> title }}</h1>

            <h2>{{ $event -> date }}</h2>

            <span>{{ $event -> type }}</span>

            <hr>

            <p>{{ $event -> description }}</p>

            <div>
                <a href="{{ route("events.edit", $event) }}">Editar</a>
                <a href="{{ route("events") }}">Volver</a>
            </div>
        </main>
    </body>
</html>