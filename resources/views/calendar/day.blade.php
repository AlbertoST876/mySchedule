<!DOCTYPE html>

<html lang="{{ app() -> getLocale() }}">
    @include("layouts.head", ["title" => __("messages.calendar") . " - " . __("messages.day")])

    <body>
        @include("layouts.header", ["current" => "calendar"])
        @include("layouts.calendar.nav", ["current" => "day"])

        <main>
            @include("layouts.warn", ["message" => session("status")])

            <div>
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="w-full" colspan="2">{{ $current }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($times as $time => $events)
                            <tr>
                                <td class="w-1/6 pr-4 bg-gray-100 text-right">{{ $time }}</td>

                                <td class="w-5/6">
                                    @foreach ($events as $event)
                                        <details class="m-1 px-4 py-2 rounded-lg" data-color="{{ is_null($event -> color) ? $event -> categoryColor : $event -> color }}">
                                            <summary>{{ $event -> category }} - {{ $event -> name }}</summary>

                                            {{ $event -> description }}
                                        </details>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>
