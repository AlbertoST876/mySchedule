<aside class="px-4 sm:px-16 md:px-32 lg:px-48 xl:px-64 2xl:px-96 pt-2 mb-8 bg-slate-100 text-sm font-medium text-center text-black border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
    <ul class="flex flex-wrap align-center justify-center lg:justify-between">
        <div class="flex flex-wrap align-center justify-center mb-2 lg:mb-0">
            <li class="mr-2"><a href="{{ route("calendar.day") }}" class="inline-block p-4 border-b-2 rounded-t-lg {{ $current == "day" ? "text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500" : "border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" }}">Día</a></li>
            <li class="mr-2"><a href="{{ route("calendar.week") }}" class="inline-block p-4 border-b-2 rounded-t-lg {{ $current == "week" ? "text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500" : "border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" }}">Semana</a></li>
            <li class="mr-2"><a href="{{ route("calendar.month") }}" class="inline-block p-4 border-b-2 rounded-t-lg {{ $current == "month" ? "text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500" : "border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" }}">Mes</a></li>
            <li class="mr-2"><a href="{{ route("calendar.year") }}" class="inline-block p-4 border-b-2 rounded-t-lg {{ $current == "year" ? "text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500" : "border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" }}">Año</a></li>
        </div>

        <div class="w-full lg:w-auto">
            <li>
                <form action="" method="get">
                    @if ($current == "day")
                        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-40 sm:w-64 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="date" name="date" value="{{ isset($_GET["date"]) ? $_GET["date"] : date("Y-m-d") }}" min="2023-01-01" required>
                    @elseif ($current == "week")
                        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-40 sm:w-64 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="week" name="date" value="{{ isset($_GET["date"]) ? $_GET["date"] : date("Y-\WW") }}" min="2023-W01" required>
                    @elseif ($current == "month")
                        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-40 sm:w-64 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="month" name="date" value="{{ isset($_GET["date"]) ? $_GET["date"] : date("Y-m") }}" min="2023-01" required>
                    @elseif ($current == "year")
                        <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-40 sm:w-64 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" name="date" value="{{ isset($_GET["date"]) ? $_GET["date"] : date("Y") }}" min="2023" required>
                    @endif

                    <input class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="submit" value="Consultar">
                </form>
            </li>
        </div>
    </ul>
</aside>
