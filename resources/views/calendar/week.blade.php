<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Calendario - Semana"])

    <body>
        @include("layouts.header")

        <main>
            <div class="px-24 pt-2 mb-8 bg-slate-100 text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                <ul class="flex flex-wrap align-center justify-center">
                    <li class="mr-2"><a href="{{ route("calendar.day") }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Día</a></li>
                    <li class="mr-2"><a href="{{ route("calendar.week") }}" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500" aria-current="page">Semana</a></li>
                    <li class="mr-2"><a href="{{ route("calendar.month") }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Mes</a></li>
                    <li class="mr-2"><a href="{{ route("calendar.year") }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Año</a></li>

                    <li class="ml-96">
                        <form action="" method="get">
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-64 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="week" name="date" value="{{ isset($_GET["date"]) ? $_GET["date"] : date("Y-\WW") }}" min="2023-W01" required>
                            <input class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="submit" value="Consultar">
                        </form>
                    </li>
                </ul>
            </div>

            <div>
                <table>
                    <thead>
                        <tr>
                            <th rowspan="2">{{ $current }}</th>
                            <th>L</th>
                            <th>M</th>
                            <th>X</th>
                            <th>J</th>
                            <th>V</th>
                            <th>S</th>
                            <th>D</th>
                        </tr>

                        <tr>
                            @foreach ($days as $day)
                                <th>
                                    <form action="{{ route("calendar.day") }}" method="get">
                                        <input type="hidden" name="date" value="{{ $day["date"] }}">
                                        <input type="submit" value="{{ $day["num"] }}">
                                    </form>
                                </th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($times as $time => $eventsDays)
                            <tr>
                                <td>{{ $time }}</td>

                                @foreach ($days as $day)
                                    @if (array_key_exists($day["num"], $eventsDays))
                                        <td>
                                            @foreach ($eventsDays[$day["num"]] as $event)
                                                <details>
                                                    <summary>{{ $event -> category }} - {{ $event -> name }}</summary>

                                                    {{ $event -> description }}
                                                </details>
                                            @endforeach
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>
