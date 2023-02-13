<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Calendario - Mes"])

    <body>
        @include("layouts.header")

        <main>
            <div class="px-24 pt-2 mb-8 bg-slate-100 text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                <ul class="flex flex-wrap align-center justify-center">
                    <li class="mr-2"><a href="{{ route("calendar.day") }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Día</a></li>
                    <li class="mr-2"><a href="{{ route("calendar.week") }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Semana</a></li>
                    <li class="mr-2"><a href="{{ route("calendar.month") }}" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500" aria-current="page">Mes</a></li>
                    <li class="mr-2"><a href="{{ route("calendar.year") }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Año</a></li>

                    <li class="ml-96">
                        <form action="" method="get">
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-64 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="month" name="date" value="{{ isset($_GET["date"]) ? $_GET["date"] : date("Y-m") }}" min="2023-01" required>
                            <input class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="submit" value="Consultar">
                        </form>
                    </li>
                </ul>
            </div>

            @if (session("status"))
                <div class="flex justify-center w-full mx-4 my-4">
                    <div id="toast-success" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Icono de Verificación</span>
                        </div>

                        <div class="ml-3 text-sm font-normal">{{ session("status") }}</div>

                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                            <span class="sr-only">Cerrar</span>
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                </div>
            @endif

            <div>
                <table>
                    <thead>
                        <tr>
                            <th colspan="8">{{ $current }}</th>
                        </tr>

                        <tr>
                            <th>Nº</th>
                            <th>L</th>
                            <th>M</th>
                            <th>X</th>
                            <th>J</th>
                            <th>V</th>
                            <th>S</th>
                            <th>D</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($weeks as $key => $week)
                            <tr>
                                <td>
                                    <form action="{{ route("calendar.week") }}" method="get">
                                        <input type="hidden" name="date" value="{{ $week["date"] }}">
                                        <input type="submit" value="{{ $week["num"] }}">
                                    </form>
                                </td>

                                @if ($key == 0 && count($week["days"]) < 7)
                                    <td colspan="{{ 7 - count($week["days"]) }}"></td>
                                @endif

                                @foreach ($week["days"] as $day)
                                    <td>
                                        <form action="{{ route("calendar.day") }}" method="get">
                                            <input type="hidden" name="date" value="{{ $day["date"] }}">
                                            <input type="submit" value="{{ $day["num"] }}">
                                        </form>

                                        @foreach ($day["events"] as $event)
                                            <div>
                                                <details>
                                                    <summary>{{ $event -> category }} - {{ $event -> name }}</summary>

                                                    {{ $event -> description }}
                                                </details>
                                            </div>
                                        @endforeach
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>
