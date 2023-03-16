<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Iniciar Sesión"])

    <body>
        @include("layouts.header", ["current" => "home"])

        <main>
            @include("layouts.warn", ["message" => session("status")])

            <form class="m-12" action="" method="post">
                @csrf

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="email">Email:</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="email" name="email" max="50" required>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="password">Contraseña:</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" type="password" name="password" max="255" required>
                </div>

                <div class="mb-6">
                    <input class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300" type="checkbox" name="remember">
                    <label class="ml-2 text-sm font-medium text-gray-900" for="remember">Recuérdame</label>
                </div>

                @include("layouts.error", ["error" => "error"])

                <div class="mb-6">
                    <input class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" type="submit" name="login" value="Iniciar Sesión">
                    <a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" href="{{ route("register") }}">Registrarse</a>
                </div>
            </form>
        </main>
    </body>
</html>
