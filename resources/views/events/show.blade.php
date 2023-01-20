<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Eventos - Ver"])

    <body>
        @include("layouts.header")

        <main>
            <h1>{{ $event -> name }}</h1>

            <h2>{{ $event -> date }}</h2>

            <span>{{ $event -> category_id }}</span>

            <hr>

            <p>{{ $event -> description }}</p>

            <div>
                <a href="{{ route("events", $event) }}">Volver</a>
                <a href="{{ route("events.edit", $event) }}">Editar</a>
                <a href="{{ route("events.delete", $event) }}">Borrar</a>
            </div>
        </main>
    </body>
</html>