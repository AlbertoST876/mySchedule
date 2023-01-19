<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Iniciar Sesión"])

    <body>
        @include("layouts.header")

        <main>
            @if (session("status"))
                <span>{{ session("status") }}</span>
            @endif

            <form action="" method="post">
                @csrf

                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" max="50" required>

                    @error("email")
                        <span>{{ $message }}</span>                        
                    @enderror
                </div>

                <div>
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" max="255" required>
                </div>

                <div>
                    <input type="checkbox" name="remember">
                    <label for="remember">Recuérdame</label>
                </div>

                <div>
                    <a href="{{ route("register") }}">Registrarse</a>
                    <input type="submit" name="login" value="Iniciar Sesión">
                </div>
            </form>
        </main>
    </body>
</html>