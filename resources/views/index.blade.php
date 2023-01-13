<!DOCTYPE html>

<html lang="es">
    <head>
        @include("layouts.head", ["title" => "Inicio"])
    </head>

    <body>
        @include("layouts.header")

        <main>
            <div>
                <h1>Mi Agenda</h1>

                <p>
                    Bienvenido a tu nueva Agenda personal almacenada en la nube, aquí podrás guardar tus notas, eventos, recordatorios, etc..., lo que necesites sin tener que instalar ninguna aplicación adicional
                    en cualquiera de tus dispositivos.
                </p>

                <div>
                    <a href="">Login</a>
                    <a href="">Register</a>
                </div>
            </div>

            <div><img src="{{ asset("resources/img/schedule.png") }}"></div>
        </main>
    </body>
</html>