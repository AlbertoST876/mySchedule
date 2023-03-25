<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Ajustes"])

    <body>
        @include("layouts.header", ["current" => "home"])

        <main>
            <div class="mx-24 my-12">
                @include("layouts.warn", ["message" => session("status")])

                <h1 class="my-6 text-5xl font-extrabold">Ajustes de la Cuenta</h1>

                <hr>

                <div class="my-8">
                    <h2 class="my-6 text-3xl font-extrabold">Colores de las Categorias</h2>

                    <form action="{{ route("settings.update") }}" method="post">
                        @csrf
                        @method("patch")

                        @foreach ($categories as $category)
                            <div class="mb-4">
                                <label class="mb-2 block text-sm font-medium text-gray-900" for="name">{{ $category -> name }}:</label>
                                <input class="p-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full md:w-3/4 lg:w-2/4 xl:w-1/4" type="color" name="{{ $category -> id }}" value="{{ $category -> color }}" required>
                            </div>
                        @endforeach

                        @include("layouts.error", ["error" => "errorColors"])

                        <input class="px-5 py-3 mr-2 mb-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" type="submit" name="colors" value="Editar">
                    </form>
                </div>

                <div class="my-8">
                    <h2 class="my-6 text-3xl font-extrabold">Foto de Perfil</h2>

                    <img class="w-32 h-32 mb-4 rounded-full" src="{{ is_null(auth() -> user() -> profileImg) ? asset("./storage/img/default-user.png") : asset(auth() -> user() -> profileImg) }}" alt="Foto de Perfil">

                    <form action="{{ route("settings.update") }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("patch")

                        <div class="mb-4">
                            <input class="block w-full md:w-3/4 lg:w-2/4 xl:w-1/4 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" type="file" name="profileImg">
                        </div>

                        @include("layouts.error", ["error" => "errorProfileImg"])

                        <input class="px-5 py-3 mr-2 mb-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" type="submit" name="image" value="Cambiar">
                    </form>
                </div>
            </div>
        </main>

        @include("layouts.footer")
    </body>
</html>
