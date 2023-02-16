<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Calendario - Semana"])

    <body>
        @include("layouts.header")

        <main>
            <div class="px-4 sm:px-16 md:px-32 lg:px-48 xl:px-64 2xl:px-96 pt-2 mb-8 bg-slate-100 text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                <ul class="flex flex-wrap align-center justify-center lg:justify-between">
                    <div class="flex flex-wrap align-center justify-center mb-2 lg:mb-0">
                        <li class="mr-2"><a href="{{ route("calendar.day") }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Día</a></li>
                        <li class="mr-2"><a href="{{ route("calendar.week") }}" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500" aria-current="page">Semana</a></li>
                        <li class="mr-2"><a href="{{ route("calendar.month") }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Mes</a></li>
                        <li class="mr-2"><a href="{{ route("calendar.year") }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Año</a></li>
                    </div>

                    <div class="w-full lg:w-auto">
                        <li>
                            <form action="" method="get">
                                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-40 sm:w-64 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="week" name="date" value="{{ isset($_GET["date"]) ? $_GET["date"] : date("Y-\WW") }}" min="2023-W01" required>
                                <input class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="submit" value="Consultar">
                            </form>
                        </li>
                    </div>
                </ul>
            </div>

            <div>
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="w-[12.5%]" rowspan="2">{{ $current }}</th>
                            <th class="w-[12.5%] border-b-0">L</th>
                            <th class="w-[12.5%] border-b-0">M</th>
                            <th class="w-[12.5%] border-b-0">X</th>
                            <th class="w-[12.5%] border-b-0">J</th>
                            <th class="w-[12.5%] border-b-0">V</th>
                            <th class="w-[12.5%] border-b-0">S</th>
                            <th class="w-[12.5%] border-b-0">D</th>
                        </tr>

                        <tr>
                            @foreach ($days as $day)
                                <th class="w-[12.5%] border-t-0">
                                    <form action="{{ route("calendar.day") }}" method="get">
                                        <input type="hidden" name="date" value="{{ $day["date"] }}">
                                        <input class="px-2 py-1 bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm focus:outline-none" type="submit" value="{{ $day["num"] }}">
                                    </form>
                                </th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($times as $time => $eventsDays)
                            <tr>
                                <td class="w-[12.5%] pr-4 bg-gray-100 text-right">{{ $time }}</td>

                                @foreach ($days as $day)
                                    <td class="w-[12.5%]">
                                        @if (array_key_exists($day["num"], $eventsDays))
                                            @foreach ($eventsDays[$day["num"]] as $event)
                                                <details class="m-1 px-4 py-2 bg-gray-100 rounded-lg">
                                                    <summary>{{ $event -> category }} - {{ $event -> name }}</summary>

                                                    {{ $event -> description }}
                                                </details>
                                            @endforeach
                                        @endif
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
