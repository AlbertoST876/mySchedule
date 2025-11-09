<!DOCTYPE html>

<html lang="{{ app() -> getLocale() }}">
    @include("layouts.head", ["title" => __("app.license")])

    <body>
        @include("layouts.header", ["current" => "home"])

        <main class="block w-full p-4">
            <div class="max-w-7xl mx-auto">
                <h1 class="block my-8 text-5xl lg:text-6xl font-extrabold">{{ mb_strtoupper(__("app.license")) }}</h1>
                <h2 class="block mb-8 text-3xl lg:text-4xl font-extrabold">@lang("app.last_update"): {{ $date }}</h2>

                <hr>

                <div class="my-8">
                    <p class="block my-4 text-justify text-lg lg:text-xl font-bold">@lang("app.license_header1")</p>
                    <p class="block my-4 text-justify text-lg lg:text-xl font-bold">@lang("app.license_header2")</p>

                    <ol class="block list-decimal list-inside">
                        <li class="my-4 text-justify text-lg lg:text-xl">@lang("app.license1")</li>
                        <li class="my-4 text-justify text-lg lg:text-xl">@lang("app.license2")</li>
                        <li class="my-4 text-justify text-lg lg:text-xl">@lang("app.license3")</li>
                        <li class="my-4 text-justify text-lg lg:text-xl">@lang("app.license4")</li>

                        <li class="my-4 text-justify text-lg lg:text-xl">
                            @lang("app.license5")

                            <ul class="block ml-8 list-disc list-inside">
                                <li class="my-4 text-justify text-lg lg:text-xl">@lang("app.license5a")</li>
                                <li class="my-4 text-justify text-lg lg:text-xl">@lang("app.license5b")</li>
                            </ul>
                        </li>

                        <li class="my-4 text-justify text-lg lg:text-xl">@lang("app.license6")</li>
                        <li class="my-4 text-justify text-lg lg:text-xl">@lang("app.license7")</li>
                        <li class="my-4 text-justify text-lg lg:text-xl">@lang("app.license8")</li>
                        <li class="my-4 text-justify text-lg lg:text-xl">@lang("app.license9")</li>
                    </ol>

                    <p class="block my-4 text-justify text-lg lg:text-xl font-bold">@lang("app.license_footer")</p>
                </div>
            </div>
        </main>

        @include("layouts.footer")
    </body>
</html>
