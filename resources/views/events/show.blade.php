<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Eventos - Ver"])

    <body>
        @include("layouts.header")

        <main>
            @foreach ($events as $event)
                <h1>{{ $event -> name }}</h1>

                <h2>{{ $event -> date }}</h2>

                <span>{{ $event -> category }}</span>

                <hr>

                <p>{{ $event -> description }}</p>

                <div>
                    <a href="{{ route("events") }}">Volver</a>

                    <form action="{{ route("events.edit") }}" method="post">
                        @csrf
            
                        <input type="hidden" name="event" value="{{ $event -> id }}">
                        <input type="submit" value="Editar">
                    </form>
            
                    <form action="{{ route("events.delete") }}" method="post">
                        @csrf
            
                        <input type="hidden" name="event" value="{{ $event -> id }}">
                        <input type="submit" value="Borrar" onclick="confirm('¿Estás seguro de que deseas borrar el evento?')">
                    </form>
                </div>
            @endforeach
        </main>
    </body>
</html>