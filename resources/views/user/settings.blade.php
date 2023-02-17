<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Ajustes"])

    <body>
        @include("layouts.header")

        <main>
            <div class="mx-24 my-12">
                <form action="{{ route("user.update") }}" method="post">
                    @csrf
                    @method("patch")

                    <div class="mb-4">
                        <h2 class="my-6 text-4xl font-extrabold dark:text-white">Colores de las Categorias:</h2>

                        @foreach ($categories as $category)
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="name">{{ $category -> name }}:</label>
                                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full md:w-3/4 lg:w-2/4 xl:w-1/4 p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="color" name="color" value="{{ $category -> color }}">
                            </div>
                        @endforeach
                    </div>

                    <input class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900" type="submit" name="edit" value="Editar">
                </form>
            </div>
        </main>

        @include("layouts.footer")
    </body>
</html>