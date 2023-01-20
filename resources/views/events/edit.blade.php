<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Eventos - Editor"])

    <body>
        @include("layouts.header")

        <main>
            <form action="" method="post">
                <select name="type" required>
                    {{ $event -> category_id }}
                </select>

                <div>
                    <label for="name">Titulo:</label>
                    <input type="text" name="title" value="{{ $event -> name }}" max="50" required>
                </div>

                <div>
                    <label for="description">Descripción:</label>
                    <input type="text" name="description" value="{{ $event -> description }}" max="255" required>
                </div>

                <div>
                    <label for="datetime"></label>
                    <input type="datetime-local" name="datetime" value="{{ $event -> date }}" min="{{ date("Y-m-d\TH:i") }}" required>
                </div>

                <input type="submit" name="edit" value="Editar">
            </form>

            <div>
                <a href="{{ route("events.show", $event) }}">Ver</a>
                <a href="{{ route("events", $event) }}">Volver</a>
            </div>
        </main>
    </body>
</html>