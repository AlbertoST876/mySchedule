<!DOCTYPE html>

<html lang="{{ app() -> getLocale() }}">
    @include("layouts.head", ["title" => __("app.about_us")])

    <body>
        @include("layouts.header", ["current" => "home"])

        <main class="block w-full p-4">
            <div class="max-w-screen-xl mx-auto">
                <h1 class="block my-8 text-5xl lg:text-6xl font-extrabold">{{ mb_strtoupper(__("app.about_us")) }}</h1>

                <hr>

                <div class="my-8">
                    <p class="block my-4 text-justify text-lg lg:text-xl">@lang("app.about_us1")</p>
                    <p class="block my-4 text-justify text-lg lg:text-xl">@lang("app.about_us2")</p>
                    <p class="block my-4 text-justify text-lg lg:text-xl">@lang("app.about_us3")</p>
                    <p class="block my-4 text-justify text-lg lg:text-xl">@lang("app.about_us4")</p>
                    <p class="block my-4 text-justify text-lg lg:text-xl">@lang("app.about_us5")</p>
                </div>
            </div>
        </main>

        @include("layouts.footer")
    </body>
</html>
