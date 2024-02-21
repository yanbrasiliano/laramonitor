<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Endpoints List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body class="bg-gray-100">
    @include('layouts.navigation')
    <div class="container mx-auto my-8 max-w-4xl">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Endpoints for {{ $site->url }}</h2>

            <button onclick="openModal('{{ $site->url }}')"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create</button>

        </div>
        @include('admin.endpoints.components.modal-create-endpoint')
        @include('admin.endpoints.components.modal-edit-endpoint')
        @include('admin.endpoints.components.modal-confirm-delete-endpoint')

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            @component('components.table-layout', ['tableId' => 'endpoints-table'])
                @slot('headers')
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Endpoint</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Frequency</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Next
                        Verification</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                @endslot
            @endcomponent

            <div id="no-data" class="hidden text-center py-4 my-4">No data available at the moment.</div>
        </div>
    </div>
</body>

</html>
<script src="{{ asset('js/endpoints/app.js') }}"></script>

<script>
    /*  LIST ALL ENDPOINTS */
    const endpoints = @json($endpoints);

    if (!endpoints.length) {
        document.getElementById('no-data').classList.remove('hidden');
    } else {
        const tbody = document.getElementById('endpoints-table').getElementsByTagName('tbody')[0];
        endpoints.forEach(endpoint => {
            let row = tbody.insertRow();
            let endpointCell = row.insertCell(0);
            let frequency = row.insertCell(1);
            let nextVerification = row.insertCell(2);
            let action = row.insertCell(3);
            endpointCell.innerHTML = endpoint.url;
            frequency.innerHTML = endpoint.frequency == 1 ? '1 minute' : endpoint.frequency + ' minutes';
            nextVerification.innerHTML = endpoint.next_check_at;

            action.innerHTML =

                `<div class="inline-flex">
                <a href="/admin/endpoints/${endpoint.id}/logs" title="View Logs">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 hover:text-green-700 cursor-pointer mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.5 14l5 5m-11-5a7 7 0 1114 0 7 7 0 01-14 0z" />
                    </svg>
                  </a>

                 <svg xmlns="http://www.w3.org/2000/svg" class="edit-icon h-6 w-6 text-blue-500 hover:text-blue-700 cursor-pointer mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" title="Editar" data-id="${endpoint.id}" data-url="${endpoint.url}" data-frequency="${endpoint.frequency}">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 4.232a1.5 1.5 0 00-2.121 0l-6.899 6.899a1 1 0 00-.263.464l-1.414 5.657a1 1 0 001.263 1.263l5.657-1.414a1 1 0 00.464-.263l6.899-6.899a1.5 1.5 0 000-2.121l-2.121-2.121z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 15.5H8v.5h-.5v-.5zm4-4H12v.5h-.5v-.5z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 hover:text-red-700 cursor-pointer delete-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" title="Delete" data-id="${endpoint.id}" data-url="${endpoint.url}">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>`;

        });
    }
    /*  CREATE ENDPOINT */
    document.getElementById('create-endpoint-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const endpoint = document.getElementById('endpoint-url').value;
        const frequency = document.getElementById('endpoint-frequency').value;

        axios.post('/admin/site/{{ $site->id }}/endpoint', {
                endpoint,
                frequency
            })
            .then(function(response) {
                window.location.reload();
            })
            .catch(function(error) {
                const errorMessageDiv = document.getElementById('error-message');
                errorMessageDiv.innerText =
                    'Error adding site. This site may already exist. Please try again.';
                errorMessageDiv.classList.remove('hidden');
                console.error(error);
            });
    });

    /*  FORMAT MODAL ENDPOINT CREATE */
    document.addEventListener('DOMContentLoaded', (event) => {
        const url = '{{ $site->url }}';
        const baseUrlInput = document.getElementById('endpoint-url');

        let urlValue = url;
        const baseUrl = urlValue;
        baseUrlInput.value = baseUrl + '/';

        baseUrlInput.addEventListener('keydown', function(e) {
            const {
                selectionStart,
                selectionEnd
            } = e.target;

            if (e.key === "Backspace" && selectionStart <= baseUrl.length + 1) {
                e.preventDefault();
            }
        });

        baseUrlInput.addEventListener('paste', function(e) {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData).getData('text');
            const completeText = baseUrl + '/' + text.replace(/https?:\/\/.*?\//, '');
            baseUrlInput.value = completeText;
            baseUrlInput.setSelectionRange(completeText.length, completeText.length);
        });

        // Set cursor position to the end of the input value when input is focused on for the first time. 
        baseUrlInput.addEventListener('focus', function(e) {
            const length = e.target.value.length;
            e.target.setSelectionRange(length, length);
        });
    });

    /*  EDIT ENDPOINT */
    document.querySelectorAll('.edit-icon').forEach(icon => {
        icon.addEventListener('click', function() {
            const endpointId = this.getAttribute('data-id');
            const endpointUrl = this.getAttribute('data-url');
            const frequency = this.getAttribute('data-frequency');
            openEditModal(endpointId, endpointUrl, frequency);
        });
    });


    document.getElementById('edit-endpoint-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const uuid = document.getElementById('endpoint-id').value;
        const endpointUrl = document.getElementById('endpoint-edit-url').value;
        const frequency = document.getElementById('endpoint-edit-frequency').value;

        axios.put(`/admin/site/{{ $site->id }}/endpoint/${uuid}`, {
                endpoint: endpointUrl,
                frequency
            })
            .then(function(response) {
                window.location.reload();
            })
            .catch(function(error) {
                const errorMessageDiv = document.getElementById('error-message');
                errorMessageDiv.innerText =
                    'Error adding site. This site may already exist. Please try again.';
                errorMessageDiv.classList.remove('hidden');
                console.error(error);
            });
    });



    /*  REMOVE ENDPOINT */

    document.querySelectorAll('.delete-icon').forEach(icon => {
        icon.addEventListener('click', function() {
            const endpointId = this.getAttribute('data-id');
            openDeleteModal(endpointId);
        });
    });

    function confirmDelete(endpointUuid) {
        const siteId = @json($site->id);

        axios.delete(`/admin/site/${siteId}/endpoint/${endpointUuid}`)
            .then(function(response) {
                window.location.reload();
            })
            .catch(function(error) {
                console.error('Error when action delete occurred:', error);
            });
        closeDeleteModal();
    }
</script>
