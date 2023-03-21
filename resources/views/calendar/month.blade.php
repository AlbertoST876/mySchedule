<!DOCTYPE html>

<html lang="es">
    @include("layouts.head", ["title" => "Calendario - Mes"])

    <body>
        @include("layouts.header", ["current" => "calendar"])
        @include("layouts.calendar.nav", ["current" => "month"])

        <main>
            @include("layouts.warn", ["message" => session("status")])

            <div>
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="w-full" colspan="8">{{ $current }}</th>
                        </tr>

                        <tr>
                            <th class="w-[12.5%]">Semana Nº</th>
                            <th class="w-[12.5%]">L</th>
                            <th class="w-[12.5%]">M</th>
                            <th class="w-[12.5%]">X</th>
                            <th class="w-[12.5%]">J</th>
                            <th class="w-[12.5%]">V</th>
                            <th class="w-[12.5%]">S</th>
                            <th class="w-[12.5%]">D</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($weeks as $key => $week)
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
                                    <td class="w-[12.5%] align-top">
                                        <form action="{{ route("calendar.day") }}" method="get">
                                            <input type="hidden" name="date" value="{{ $day["date"] }}">
                                            <input class="mb-2 px-2 py-1 bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm focus:outline-none" type="submit" value="{{ $day["num"] }}">
                                        </form>

                                        @foreach ($day["events"] as $event)
                                            <details class="m-1 px-4 py-2 rounded-lg" data-color="{{ is_null($event -> color) ? $event -> categoryColor : $event -> color }}">
                                                <summary>{{ $event -> category }} - {{ $event -> name }}</summary>

                                                {{ $event -> description }}
                                            </details>
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
