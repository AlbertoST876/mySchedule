<!DOCTYPE html>

<html lang="{{ app() -> getLocale() }}">
    @include("layouts.head", ["title" => __("app.settings")])

    <body>
        @include("layouts.header", ["current" => "home"])

        <main>
            <div class="mx-6 my-12 lg:mx-24 lg:my-12">
                @include("layouts.warn", ["message" => session("status")])

                <h1 class="my-6 text-5xl font-extrabold">@lang("app.account_settings")</h1>

                <hr>

                <div class="my-8">
                    <h2 class="mb-6 text-3xl font-extrabold">@lang("app.categories_colors")</h2>

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

                        <input class="px-5 py-3 mr-2 mb-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" type="submit" name="colors" value="@lang("app.change")">
                    </form>
                </div>

                <div class="my-8">
                    <h2 class="mb-6 text-3xl font-extrabold">@lang("app.profileImg")</h2>

                    <img class="w-32 h-32 mb-4 rounded-full" src="{{ is_null(auth() -> user() -> profileImg) ? asset("./storage/img/default-user.png") : asset(auth() -> user() -> profileImg) }}" alt="@lang("app.alt_profileImg")">

                    <form action="{{ route("settings.update") }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("patch")

                        <div class="mb-4">
                            <input class="block w-full md:w-3/4 lg:w-2/4 xl:w-1/4 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" type="file" name="profileImg">
                        </div>

                        @include("layouts.error", ["field" => "profileImg"])

                        <div class="mb-4">
                            <ul class="mb-4 max-w-full space-y-1 text-gray-500 list-disc list-inside">
                                <li>@lang("app.profileImg_formats")</li>
                                <li>@lang("app.profileImg_size")</li>
                                <li>@lang("app.profileImg_dimensions")</li>
                            </ul>

                            <span class="text-gray-500">@lang("app.profileImg_recomendation")</span>
                        </div>

                        <input class="px-5 py-3 mr-2 mb-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" type="submit" name="image" value="@lang("app.change")">

                        @if (isset(Auth::user() -> profileImg))
                            <button type="button" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="mr-2 my-2 px-5 py-3 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm">@lang("app.delete")</button>

                            <div id="deleteModal" tabindex="-1" aria-hidden="true" class="p-4 fixed top-0 left-0 right-0 z-50 hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                <div class="relative w-full h-full max-w-2xl md:h-auto">
                                    <div class="relative bg-white rounded-lg shadow">
                                        <div class="p-4 flex items-start justify-between border-b rounded-t">
                                            <h3 class="text-xl font-semibold text-gray-900">@lang("app.profileImg_delete_confirm")</h3>
                                        </div>

                                        <div class="p-4 flex items-center space-x-2 border-t border-gray-200 rounded-b">
                                            <input class="px-5 py-3 mr-2 mb-2 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm" type="submit" name="deleteImage" value="@lang("app.delete")">
                                            <button type="button" class="px-5 py-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center" data-modal-hide="deleteModal">@lang("app.cancel")</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>

                <div class="my-8">
                    <h2 class="mb-6 text-3xl font-extrabold">@lang("app.timeZone")</h2>

                    <form action="{{ route("settings.update") }}" method="post">
                        @csrf
                        @method("patch")

                        <div class="mb-6">
                            <select class="block w-full md:w-3/4 lg:w-2/4 xl:w-1/4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500" name="timezone" required>
                                @foreach ($regions as $region)
                                    <optgroup label="{{ $region -> name }}">
                                        @foreach ($region -> timezones as $timezone)
                                            @php $city = "city_" . app() -> getLocale(); @endphp

                                            <option value="{{ $timezone -> id }}" {{ Auth::user() -> timezone_id == $timezone -> id ? "selected" : "" }}>{{ $timezone -> $city }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>

                            @include("layouts.error", ["field" => "timezone"])
                        </div>

                        <input class="px-5 py-3 mr-2 mb-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm focus:outline-none" type="submit" name="time" value="@lang("app.change")">
                    </form>
                </div>
            </div>
        </main>

        @include("layouts.footer")
    </body>
</html>
