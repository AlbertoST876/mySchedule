<!DOCTYPE html>

<html lang="{{ app() -> getLocale() }}">
    @include("layouts.head", ["title" => __("messages.calendar") . " - " . __("messages.week")])

    <body>
        @include("layouts.header", ["current" => "calendar"])
        @include("layouts.calendar.nav", ["current" => "week"])

        <main>
            @include("layouts.warn", ["message" => session("status")])

            <div>
                <table class="block w-full overflow-x-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="w-[12.5%] min-w-[200px]" rowspan="2">{{ $current }}</th>
                            <th class="w-[12.5%] min-w-[200px] border-b-0">@lang("messages.monday")</th>
                            <th class="w-[12.5%] min-w-[200px] border-b-0">@lang("messages.thuesday")</th>
                            <th class="w-[12.5%] min-w-[200px] border-b-0">@lang("messages.wednesday")</th>
                            <th class="w-[12.5%] min-w-[200px] border-b-0">@lang("messages.thursday")</th>
                            <th class="w-[12.5%] min-w-[200px] border-b-0">@lang("messages.friday")</th>
                            <th class="w-[12.5%] min-w-[200px] border-b-0">@lang("messages.saturday")</th>
                            <th class="w-[12.5%] min-w-[200px] border-b-0">@lang("messages.sunday")</th>
                        </tr>

                        <tr>
                            @foreach ($days as $day)
                                <th class="w-[12.5%] min-w-[200px] border-t-0">
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
                                <td class="pr-4 bg-gray-100 text-right">{{ $time }}</td>

                                @foreach ($days as $day)
                                    <td>
                                        @if (array_key_exists($day["num"], $eventsDays))
                                            @foreach ($eventsDays[$day["num"]] as $event)
                                                <details class="m-1 px-4 py-2 rounded-lg" data-color="{{ is_null($event -> color) ? $event -> categoryColor : $event -> color }}">
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
