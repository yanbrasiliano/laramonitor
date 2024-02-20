<div id="{{ $id ?? 'genericModal' }}"
    class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="{{ $id ?? 'genericModal' }}-title">
                {{ $title }}</h3>
            <div id="{{ $id ?? 'genericModal' }}-content" class="mt-2">
                {{ $slot }}
            </div>
            <div class="items-center px-4 py-3">
                <button id="{{ $id ?? 'genericModal' }}-cancelBtn"
                    onclick="closeDeleteModal('{{ $id ?? 'genericModal' }}')"
                    class="px-4 py-2 bg-gray-200 text-gray-800 text-base font-medium rounded-md shadow-sm hover:bg-gray-300">Cancel</button>
                <button id="{{ $id ?? 'genericModal' }}-confirmBtn"
                    class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none">{{ $confirmText }}</button>
            </div>
        </div>
    </div>
</div>
