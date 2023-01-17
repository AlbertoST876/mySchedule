<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Iniciar Sesión"])

    <body>
        @include("layouts.header")

        <main>
            <form action="" method="post">
                @csrf

                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" max="50" required>
                </div>

                <div>
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" max="255" required>
                </div>

                <div>
                    <a href="{{ route("register") }}">Registrarse</a>
                    <input type="submit" name="login" value="Iniciar Sesión">
                </div>
            </form>
        </main>
    </body>
</html>