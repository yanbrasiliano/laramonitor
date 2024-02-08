<!-- Modal Create -->
<div id="modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        @component('admin.sites.components.partials.modal-common', [
            'title' => 'Add New Site',
            'closeAction' => 'closeModal()',
        ])
            @slot('slot')
                <form id="add-site-form">
                    <input type="url" id="site-url" name="url" placeholder="Enter site URL"
                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    <div class="items-center px-4 py-3">
                        <button type="button" onclick="closeModal()"
                            class="px-4 py-2 bg-gray-200 text-gray-800 text-base font-medium rounded-md w-auto shadow-sm hover:bg-gray-300">Cancel</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-auto shadow-sm hover:bg-blue-700 focus:outline-none">Add</button>
                    </div>
                </form>
            @endslot
        @endcomponent
        <div id="error-message" class="hidden text-sm text-red-600 mt-2"></div>
    </div>
</div>
