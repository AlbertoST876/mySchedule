<aside class="px-4 mb-8 sm:px-16 md:px-32 lg:px-48 xl:px-64 2xl:px-96 pt-2 bg-slate-100 text-sm font-medium text-center text-black border-b border-gray-200">
    <ul class="flex flex-wrap align-center justify-center lg:justify-between">
        <div class="mb-2 lg:mb-0 flex flex-wrap align-center justify-center">
            <li class="mr-2"><a href="{{ route("calendar.day") }}" class="p-4 inline-block border-b-2 rounded-t-lg {{ $current == "day" ? "text-blue-600 border-blue-600 active" : "border-transparent hover:text-gray-600 hover:border-gray-300" }}">@lang("messages.day")</a></li>
            <li class="mr-2"><a href="{{ route("calendar.week") }}" class="p-4 inline-block border-b-2 rounded-t-lg {{ $current == "week" ? "text-blue-600 border-blue-600 active" : "border-transparent hover:text-gray-600 hover:border-gray-300" }}">@lang("messages.week")</a></li>
            <li class="mr-2"><a href="{{ route("calendar.month") }}" class="p-4 inline-block border-b-2 rounded-t-lg {{ $current == "month" ? "text-blue-600 border-blue-600 active" : "border-transparent hover:text-gray-600 hover:border-gray-300" }}">@lang("messages.month")</a></li>
            <li><a href="{{ route("calendar.year") }}" class="p-4 inline-block border-b-2 rounded-t-lg {{ $current == "year" ? "text-blue-600 border-blue-600 active" : "border-transparent hover:text-gray-600 hover:border-gray-300" }}">@lang("messages.year")</a></li>
        </div>

        <div class="w-full lg:w-auto">
            <li>
                <form action="" method="get">
                    @if ($current == "day")
                        <input class="w-40 sm:w-64 p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500" type="date" name="date" value="{{ isset($_GET["date"]) ? $_GET["date"] : date("Y-m-d") }}" min="2023-01-01" required>
                    @elseif ($current == "week")
                        <input class="w-40 sm:w-64 p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500" type="week" name="date" value="{{ isset($_GET["date"]) ? $_GET["date"] : date("Y-\WW") }}" min="2023-W01" required>
                    @elseif ($current == "month")
                        <input class="w-40 sm:w-64 p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500" type="month" name="date" value="{{ isset($_GET["date"]) ? $_GET["date"] : date("Y-m") }}" min="2023-01" required>
                    @elseif ($current == "year")
                        <input class="w-40 sm:w-64 p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500" type="number" name="date" value="{{ isset($_GET["date"]) ? $_GET["date"] : date("Y") }}" min="2023" required>
                    @endif

                    <input class="mx-2 mb-2 px-5 py-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" type="submit" value="@lang("messages.consult")">
                </form>
            </li>
        </div>
    </ul>
</aside>
