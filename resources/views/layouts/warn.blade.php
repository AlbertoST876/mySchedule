@if ($message)
    <div class="m-4 sticky top-12 flex justify-center w-full">
        <div id="toast-success" class="p-4 flex items-center w-full max-w-xs text-gray-500 bg-white rounded-lg shadow" role="alert">
            <div class="w-8 h-8 inline-flex items-center justify-center flex-shrink-0 text-green-500 bg-green-100 rounded-lg">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">@lang("app.verification_icon")</span>
            </div>

            <div class="ml-3 text-sm font-normal">{{ $message }}</div>

            <button type="button" class="ml-auto -m-1.5 p-1.5 w-8 h-8 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 hover:bg-gray-100 inline-flex" data-dismiss-target="#toast-success" aria-label="Close">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">@lang("app.close")</span>
            </button>
        </div>
    </div>
@endif
