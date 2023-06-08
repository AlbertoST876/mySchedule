<!DOCTYPE html>

<html lang="{{ app() -> getLocale() }}">
    @include("layouts.head", ["title" => __("messages.settings")])

    <body>
        @include("layouts.header", ["current" => "home"])

        <main>
            <div class="mx-6 my-12 lg:mx-24 lg:my-12">
                @include("layouts.warn", ["message" => session("status")])

                <h1 class="my-6 text-5xl font-extrabold">@lang("messages.account_settings")</h1>

                <hr>

                <div class="my-8">
                    <h2 class="mb-6 text-3xl font-extrabold">@lang("messages.categories_colors")</h2>

                    <form action="{{ route("settings.update") }}" method="post">
                        @csrf
                        @method("patch")

                        @foreach ($categories as $category)
                            <div class="mb-4">
                                <label class="mb-2 block text-sm font-medium text-gray-900" for="{{ $category -> id }}">{{ $category -> name }}:</label>
                                <input class="p-1 block w-full md:w-3/4 lg:w-2/4 xl:w-1/4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500" type="color" name="{{ $category -> id }}" value="{{ $category -> color }}" required>

                                @include("layouts.error", ["field" => $category -> id])
                            </div>
                        @endforeach

                        <input class="px-5 py-3 mr-2 mb-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" type="submit" name="colors" value="@lang("messages.change")">
                    </form>
                </div>

                <div class="my-8">
                    <h2 class="mb-6 text-3xl font-extrabold">@lang("messages.profileImg")</h2>

                    <img class="w-32 h-32 mb-4 rounded-full" src="{{ is_null(auth() -> user() -> profileImg) ? asset("./storage/img/default-user.png") : asset(auth() -> user() -> profileImg) }}" alt="@lang("messages.alt_profileImg")">

                    <form action="{{ route("settings.update") }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("patch")

                        <div class="mb-4">
                            <input class="block w-full md:w-3/4 lg:w-2/4 xl:w-1/4 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" type="file" name="profileImg">
                        </div>

                        @include("layouts.error", ["field" => "profileImg"])

                        <div class="mb-4">
                            <ul class="mb-4 max-w-full space-y-1 text-gray-500 list-disc list-inside">
                                <li>@lang("messages.profileImg_formats")</li>
                                <li>@lang("messages.profileImg_size")</li>
                                <li>@lang("messages.profileImg_dimensions")</li>
                            </ul>

                            <span class="text-gray-500">@lang("messages.profileImg_recomendation")</span>
                        </div>

                        <input class="px-5 py-3 mr-2 mb-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" type="submit" name="image" value="@lang("messages.change")">

                        @if (isset(Auth::user() -> profileImg))
                            <input class="px-5 py-3 mr-2 mb-2 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm" type="submit" name="deleteImage" value="@lang("messages.delete")" onclick="return confirm('@lang("messages.profileImg_delete_confirm")')">
                        @endif
                    </form>
                </div>

                <div class="my-8">
                    <h2 class="mb-6 text-3xl font-extrabold">@lang("messages.timeZone")</h2>

                    <form action="{{ route("settings.update") }}" method="post">
                        @csrf
                        @method("patch")

                        <div class="mb-6">
                            <select class="block w-full md:w-3/4 lg:w-2/4 xl:w-1/4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500" name="timezone" required>
                                @foreach ($regions as $region)
                                    <optgroup label="{{ $region -> name }}">
                                        @foreach ($region -> timezones as $timezone)
                                            <option value="{{ $timezone -> id }}" {{ Auth::user() -> timezone_id == $timezone -> id ? "selected" : "" }}>{{ $timezone -> city }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>

                            @include("layouts.error", ["field" => "timezone"])
                        </div>

                        <input class="px-5 py-3 mr-2 mb-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" type="submit" name="time" value="@lang("messages.change")">
                    </form>
                </div>
            </div>
        </main>

        @include("layouts.footer")
    </body>
</html>
