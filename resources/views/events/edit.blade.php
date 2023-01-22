<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Eventos - Editor"])

    <body>
        @include("layouts.header")

        <main>
            <form action="{{ route("events.update") }}" method="post">
                @csrf
                @method("patch")

                <select name="category" required>
                    @foreach ($categories as $category)
                        @if ($category -> id == $event -> category_id)
                            <option value="{{ $category -> id }}" selected>{{ $category -> name }}</option>
                        @else
                            <option value="{{ $category -> id }}">{{ $category -> name }}</option>
                        @endif
                    @endforeach
                </select>

                <div>
                    <label for="name">Titulo:</label>
                    <input type="text" name="name" value="{{ $event -> name }}" max="50" required>
                </div>

                <div>
                    <label for="description">Descripción:</label>
                    <input type="text" name="description" value="{{ $event -> description }}" max="255" required>
                </div>

                <div>
                    <label for="datetime"></label>
                    <input type="datetime-local" name="date" value="{{ $event -> date }}" min="{{ date("Y-m-d\TH:i") }}" required>
                </div>

                <input type="hidden" name="event" value="{{ $event -> id }}">
                <input type="submit" name="edit" value="Editar">
            </form>

            <div>
                <form action="{{ route("events.show") }}" method="post">
                    @csrf
        
                    <input type="hidden" name="event" value="{{ $event -> id }}">
                    <input type="submit" value="Ver">
                </form>
        
                <form action="{{ route("events.delete") }}" method="post">
                    @csrf
        
                    <input type="hidden" name="event" value="{{ $event -> id }}">
                    <input type="submit" value="Borrar" onclick="confirm('¿Estás seguro de que deseas borrar el evento?')">
                </form>
            </div>
        </main>
    </body>
</html>