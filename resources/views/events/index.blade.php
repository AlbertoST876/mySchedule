<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Eventos"])

    <body>
        @include("layouts.header")

        <aside>
            <h1>Añadir</h1>

            <hr>

            <form action="" method="post">
                <select name="type" required>
                    
                </select>

                <div>
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" max="50" required>
                </div>

                <div>
                    <label for="description">Descripción:</label>
                    <input type="text" name="description" max="255" required>
                </div>

                <div>
                    <label for="datetime"></label>
                    <input type="datetime-local" name="datetime" value="{{ date("Y-m-d\TH:i") }}" min="{{ date("Y-m-d\TH:i") }}" required>
                </div>

                <input type="submit" name="create" value="Crear">
            </form>
        </aside>

        <main>
            
        </main>
    </body>
</html>