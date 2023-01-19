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
                    <input type="email" name="email" value="{{ old("email") }}" max="50" required>

                    @error("email")
                        <span>{{ $message }}</span>                        
                    @enderror
                </div>

                <div>
                    <label for="name">Nombre de Usuario:</label>
                    <input type="text" name="name" value="{{ old("name") }}" max="25" required>

                    @error("name")
                        <span>{{ $message }}</span>                        
                    @enderror
                </div>

                <div>
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" max="255" required>

                    @error("password")
                        <span>{{ $message }}</span>                        
                    @enderror
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