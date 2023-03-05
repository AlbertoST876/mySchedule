<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Ajustes"])

    <body>
        @include("layouts.header", ["current" => "home"])

        <main>
            <div class="mx-24 my-12">
                @include("layouts.warn", ["message" => session("status")])

                <h1 class="my-6 text-5xl font-extrabold dark:text-white">Ajustes de la Cuenta</h1>

                <hr>

                <div class="my-8">
                    <h2 class="my-6 text-3xl font-extrabold dark:text-white">Colores de las Categorias</h2>

                    <form action="{{ route("settings.update") }}" method="post">
                        @csrf
                        @method("patch")

                        @foreach ($categories as $category)
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="name">{{ $category -> name }}:</label>
                                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full md:w-3/4 lg:w-2/4 xl:w-1/4 p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="color" name="{{ $category -> id }}" value="{{ $category -> color }}" required>
                            </div>
                        @endforeach

                        @error("errorColors")
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror

                        <input class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="submit" name="colors" value="Editar">
                    </form>
                </div>

                <div class="my-8">
                    <h2 class="my-6 text-3xl font-extrabold dark:text-white">Foto de Perfil</h2>

                    <img class="w-32 h-32 mb-4 rounded-full" src="{{ is_null(auth() -> user() -> profile_img) ? asset("./storage/img/default-user.png") : asset(auth() -> user() -> profile_img) }}" alt="Foto de Perfil">

                    <form action="{{ route("settings.update") }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("patch")

                        <div class="mb-4">
                            <input class="block w-full md:w-3/4 lg:w-2/4 xl:w-1/4 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="profileImg">
                        </div>

                        @error("errorProfileImg")
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror

                        <input class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="submit" name="image" value="Cambiar">
                    </form>
                </div>
            </div>
        </main>

        @include("layouts.footer")
    </body>
</html>
