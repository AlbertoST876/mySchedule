<!DOCTYPE html>

<html lang="{{ app() -> getLocale() }}">
    @include("layouts.head", ["title" => __("app.privacy_policy")])

    <body>
        @include("layouts.header", ["current" => "home"])

        <main class="block w-full p-4">
            <div class="max-w-screen-xl mx-auto">
                @php $date = new DateTime("2024-12-07"); @endphp

                <h1 class="block my-8 text-5xl lg:text-6xl font-extrabold">{{ mb_strtoupper(__("app.privacy_policy")) }}</h1>
                <h2 class="block mb-8 text-3xl lg:text-4xl font-extrabold">@lang("app.last_update"): {{ $date -> format($dateFormat) }}</h2>

                <hr>

                <div class="my-8">
                    <p class="block my-4 text-justify text-lg lg:text-xl font-bold">@lang("app.privacy_policy_header")</p>

                    <ol class="block list-decimal list-inside">
                        <li class="my-4 text-justify text-lg lg:text-xl">@lang("app.privacy_policy1")</li>
                        <li class="my-4 text-justify text-lg lg:text-xl">@lang("app.privacy_policy2")</li>
                        <li class="my-4 text-justify text-lg lg:text-xl">@lang("app.privacy_policy3")</li>
                        <li class="my-4 text-justify text-lg lg:text-xl">@lang("app.privacy_policy4")</li>
                        <li class="my-4 text-justify text-lg lg:text-xl">@lang("app.privacy_policy5")</li>
                        <li class="my-4 text-justify text-lg lg:text-xl">@lang("app.privacy_policy6")</li>
                        <li class="my-4 text-justify text-lg lg:text-xl">@lang("app.privacy_policy7")</li>
                        <li class="my-4 text-justify text-lg lg:text-xl">@lang("app.privacy_policy8")</li>
                    </ol>

                    <p class="block my-4 text-justify text-lg lg:text-xl font-bold">@lang("app.privacy_policy_footer")</p>
                </div>
            </div>
        </main>

        @include("layouts.footer")
    </body>
</html>
