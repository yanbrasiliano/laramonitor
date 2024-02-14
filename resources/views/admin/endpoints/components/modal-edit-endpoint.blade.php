<div id="modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        @component('admin.endpoints.components.partials.modal-common', [
            'title' => 'Edit Endpoint',
        ])
            @slot('content')
                <form id="edit-endpoint-form">
                    <input type="text" id="endpoint-url" name="url" placeholder="Enter endpoint URL"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    <div class="mt-4">
                        <input type="number" id="endpoint-frequency" name="frequency" placeholder="Frequency (in minutes)"
                            min="1" step="1"
                            class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                        <p class="text-xs text-gray-500 mt-1">Enter the frequency in minutes</p>
                    </div>
                    <div class="mt-2">
                        <button type="button" onclick="closeModal()"
                            class="px-4 py-2 bg-gray-200 text-gray-800 text-base font-medium rounded-md w-auto shadow-sm hover:bg-gray-300">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-auto shadow-sm hover:bg-blue-700 focus:outline-none">Save</button>
                    </div>
                </form>
            @endslot
        @endcomponent
    </div>
</div>
