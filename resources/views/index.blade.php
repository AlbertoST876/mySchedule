<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Inicio"])

    <body>
        @include("layouts.header")

        <main>
            @if (session("status"))
                <span>{{ session("status") }}</span>
            @endif

            <div>
                <h1>Mi Agenda</h1>

                <p>Bienvenido a tu nueva Agenda personal almacenada en la nube, aquí podrás guardar tus notas, eventos, recordatorios, etc..., lo que necesites sin tener que instalar ninguna aplicación adicional en cualquiera de tus dispositivos.</p>

                <div>
                    @guest
                        <a href="{{ route("login") }}">Iniciar Sesión</a>
                        <a href="{{ route("register") }}">Registrarse</a>
                    @endguest
                </div>
            </div>

            <div><img src="{{ asset("storage/img/schedule.png") }}"></div>
        </main>
    </body>
</html>