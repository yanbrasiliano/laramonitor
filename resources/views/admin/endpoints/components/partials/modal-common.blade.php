<div class="mt-3 text-center">
    <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $title }}</h3>
    {{ $content }}
    <div class="items-center px-4 py-3 mt-4">
        <button type="button" onclick="{{ $closeAction }}"
            class="px-4 py-2 bg-gray-200 text-gray-800 text-base font-medium rounded-md w-auto shadow-sm hover:bg-gray-300">Cancel</button>
        {{ $actionButton }}
    </div>
    <div id="error-message" class="hidden text-sm text-red-600 mt-2"></div>
</div>
