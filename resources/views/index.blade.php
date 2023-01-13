<!DOCTYPE html>

<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Alberto Sánchez Torreblanca">
        <link rel="icon" href="{{ asset('icon.png') }}">
        <title>Mi Agenda - Inicio</title>
    </head>

    <body>
        @include("layouts.header")

        <main>
            <h1>Inicio</h1>

            <hr>

            <h2>Bienvenida</h2>

            <p>
                Bienvenido a tu nueva Agenda personal almacenada en la nube, aquí podrás guardar tus notas, eventos, recordatorios, etc..., lo que necesites sin tener que instalar ninguna aplicación adicional
                en cualquiera de tus dispositivos.
            </p>

            <p>
                Esta agenda esta hecha con fines educativos y entre otros para su correcto uso.
            </p>
        </main>
    </body>
</html>