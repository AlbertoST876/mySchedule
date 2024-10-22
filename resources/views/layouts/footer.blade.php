<footer class="px-6 py-8 bg-slate-100 rounded-lg shadow lg:flex lg:justify-between">
    <span class="block lg:inline-block text-sm text-gray-500">©{{ date("Y") }} <a href="{{ route("index") }}" class="hover:underline">@lang("app.appName")</a>. @lang("app.all_rights_reserved")</span>

    <ul class="mt-3 lg:mt-0 flex lg:inline-flex flex-wrap items-center justify-between sm:justify-normal text-sm text-gray-500">
        <li><a href="" class="mr-0 sm:mr-4 md:mr-6 hover:underline">@lang("app.about_us")</a></li>
        <li><a href="" class="mr-0 sm:mr-4 md:mr-6 hover:underline">@lang("app.privacy_policy")</a></li>
        <li><a href="" class="mr-0 sm:mr-4 md:mr-6 hover:underline">@lang("app.license")</a></li>
        <li><a href="" class="hover:underline">@lang("app.contact")</a></li>
    </ul>
</footer>
