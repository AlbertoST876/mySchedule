<!DOCTYPE html>

<html lang="{{ app() -> getLocale() }}">
    @include("layouts.head", ["title" => __("app.home")])

    <body>
        @include("layouts.header", ["current" => "home"])

        <main>
            @include("layouts.warn", ["message" => session("status")])

            <div class="mx-8 my-12 lg:m-24 grid gap-12 lg:gap-24 grid-cols-1 grid-rows-2 lg:grid-cols-2 lg:grid-rows-1">
                <div>
                    <h1 class="text-5xl lg:text-6xl font-extrabold">@lang("app.appName")</h1>

                    <p class="my-6 text-lg lg:text-xl text-justify">@lang("app.intro")</p>

                    @guest
                        <div class="flex items-center justify-between sm:justify-center">
                            <a class="mr-0 sm:mr-32 mb-2 px-6 py-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" href="{{ route("login") }}">@lang("app.login")</a>
                            <a class="mb-2 px-6 py-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" href="{{ route("register") }}">@lang("app.register")</a>
                        </div>
                    @endguest
                </div>

                <div><img class="border border-solid border-black rounded-md shadow-md" src="{{ asset("storage/img/schedule.jpg") }}" alt="@lang("app.alt_appImg")"></div>
            </div>
        </main>

        @include("layouts.footer")
    </body>
</html>
