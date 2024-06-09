<div id="deleteModal" tabindex="-1" aria-hidden="true" class="p-4 fixed top-0 left-0 right-0 z-50 hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-2xl md:h-auto">
        <div class="relative bg-white rounded-lg shadow">
            <div class="p-4 flex items-start justify-between border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">@lang("app.delete_confirm")</h3>
            </div>

            <form action="{{ route("events.destroy") }}" method="post">
                @csrf
                @method("delete")

                <input id="deleteEventId" type="hidden" name="event">

                <div class="p-4 flex items-center space-x-2 border-t border-gray-200 rounded-b">
                    <input class="mr-2 my-2 px-5 py-3 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm" type="submit" value="@lang("app.delete")">
                    <button type="button" class="px-5 py-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center" data-modal-hide="deleteModal">@lang("app.cancel")</button>
                </div>
            </form>
        </div>
    </div>
</div>
