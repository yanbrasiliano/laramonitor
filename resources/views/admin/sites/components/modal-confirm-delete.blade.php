<div id="deleteConfirmationModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Exclusion Confirmation</h3>
            <div class="mt-2">
                <p class="text-sm text-gray-500">Are you sure you want to delete this site? This action cannot be
                    undone.</p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="cancelDeleteBtn" onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-200 text-gray-800 text-base font-medium rounded-md shadow-sm hover:bg-gray-300">Cancel</button>
                <button id="confirmDeleteBtn"
                    class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none">Confirm</button>
            </div>
        </div>
    </div>
</div>
