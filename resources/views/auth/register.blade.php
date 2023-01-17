<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Registro"])

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
                    <label for="username">Nombre de Usuario:</label>
                    <input type="text" name="username" max="25" required>
                </div>

                <div>
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" max="255" required>
                </div>

                <div>
                    <label for="password_confirmation">Contraseña:</label>
                    <input type="password" name="password_confirmation" max="255" required>
                </div>

                <div>
                    <a href="{{ route("login") }}">Iniciar Sesión</a>
                    <input type="submit" name="register" value="Registrarse">
                </div>
            </form>
        </main>
    </body>
</html>