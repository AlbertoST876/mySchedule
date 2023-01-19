<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Eventos"])

    <body>
        @include("layouts.header")

        <main>
            <aside>
                <h1>Añadir</h1>
    
                <hr>
    
                <form action="" method="post">
                    <select name="type" required>
                        @php
                            $categories = DB::table("categories") -> get();
                        @endphp

                        @foreach ($categories as $category)
                            <option value="{{ $category -> id }}">{{ $category -> name }}</option>
                        @endforeach
                    </select>
    
                    <div>
                        <label for="name">Nombre:</label>
                        <input type="text" name="name" max="50" required>
                    </div>
    
                    <div>
                        <label for="description">Descripción:</label>
                        <input type="text" name="description" max="255">
                    </div>
    
                    <div>
                        <label for="datetime">Fecha y Hora:</label>
                        <input type="datetime-local" name="datetime" value="{{ date("Y-m-d\TH:i") }}" min="{{ date("Y-m-d\TH:i") }}" required>
                    </div>
    
                    <input type="submit" name="create" value="Crear">
                </form>
            </aside>

            @include("layouts.events.userEvents", ["user_id" => Auth::User() -> id])
        </main>
    </body>
</html>