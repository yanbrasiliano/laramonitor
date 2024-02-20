@component('components.modal-common-confirm-delete', [
    'title' => 'Exclusion Confirmation',
    'id' => 'deleteEndpointConfirmationModal',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
])
    @slot('slot')
        <p class="text-sm text-gray-500">Are you sure you want to delete this endpoint? This action cannot be undone.</p>
        <input type="hidden" id="endpoint-delete-id">
        <input type="hidden" id="endpoint-delete-url">
    @endslot
@endcomponent
