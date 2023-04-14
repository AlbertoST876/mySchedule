<!DOCTYPE html>

<html lang="{{ app() -> getLocale() }}">
    @include("layouts.head", ["title" => __("messages.calendar") . " - " . __("messages.year")])

    <body>
        @include("layouts.header", ["current" => "calendar"])
        @include("layouts.calendar.nav", ["current" => "year"])

        <main>
            @include("layouts.warn", ["message" => session("status")])

            <div>
                <div class="w-full text-center font-bold border-b border-b-black">@lang("messages.year") {{ $current }}</div>

                <div class="flex flex-wrap align-center justify-center">
                    @foreach ($months as $month)
                        <table class="w-1/6 m-6">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="w-full" colspan="8">
                                        <form action="{{ route("calendar.month") }}" method="get">
                                            <input type="hidden" name="date" value="{{ $month["date"] }}">
                                            <input class="px-2 py-1 bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm focus:outline-none" type="submit" value="{{ $month["name"] }}">
                                        </form>
                                    </th>
                                </tr>

                                <tr>
                                    <th class="w-[12.5%]">@lang("messages.week_number")</th>
                                    <th class="w-[12.5%]">@lang("messages.monday")</th>
                                    <th class="w-[12.5%]">@lang("messages.thuesday")</th>
                                    <th class="w-[12.5%]">@lang("messages.wednesday")</th>
                                    <th class="w-[12.5%]">@lang("messages.thursday")</th>
                                    <th class="w-[12.5%]">@lang("messages.friday")</th>
                                    <th class="w-[12.5%]">@lang("messages.saturday")</th>
                                    <th class="w-[12.5%]">@lang("messages.sunday")</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($month["weeks"] as $key => $week)
                                    <tr>
                                        <td class="w-[12.5%] pr-4 bg-gray-100 text-center">
                                            <form action="{{ route("calendar.week") }}" method="get">
                                                <input type="hidden" name="date" value="{{ $week["date"] }}">
                                                <input class="px-2 py-1 bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm focus:outline-none" type="submit" value="{{ $week["num"] }}">
                                            </form>
                                        </td>

                                        @if ($key == 0 && count($week["days"]) < 7)
                                            <td class="w-auto" colspan="{{ 7 - count($week["days"]) }}"></td>
                                        @endif

                                        @foreach ($week["days"] as $day)
                                            <td class="w-[12.5%] text-center align-top">
                                                <form action="{{ route("calendar.day") }}" method="get">
                                                    <input type="hidden" name="date" value="{{ $day["date"] }}">
                                                    <input class="mb-2 px-2 py-1 bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm focus:outline-none" type="submit" value="{{ $day["num"] }}">
                                                </form>

                                                @if ($day["events"] > 0)
                                                    <div class="mt-2 py-1 rounded-full" data-color="{{ $day["color"] }}">{{ $day["events"] }}</div>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div>
        </main>
    </body>
</html>
