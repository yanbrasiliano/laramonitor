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
    const endpoints = @json($endpoints);
    if (!endpoints.length) {
        document.getElementById('no-data').classList.remove('hidden');
    } else {
        const tbody = document.getElementById('endpoints-table').getElementsByTagName('tbody')[0];
        endpoints.forEach(endpoint => {
            console.log(endpoint);
            let row = tbody.insertRow();
            let endpointCell = row.insertCell(0);
            let frequencyCell = row.insertCell(1);
            let nextVerificationCell = row.insertCell(2);
            let actionCell = row.insertCell(3);

            endpointCell.innerHTML = endpoint.endpoint;
            frequencyCell.innerHTML = endpoint.frequency;
            nextVerificationCell.innerHTML = endpoint.next_check_at;
            
        });
    }
    /*  CREATE SITE */
    document.getElementById('create-endpoint-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const endpoint = document.getElementById('endpoint-url').value;
        const frequency = document.getElementById('endpoint-frequency').value;

        axios.post('/admin/sites/{{ $site->id }}/endpoint', {
                endpoint,
                frequency
            })
            .then(function(response) {
                window.location.reload();
            })
            .catch(function(error) {
                console.log(error);
            });
    });


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

        // Quando o input ganha foco, move o cursor para o final do texto
        baseUrlInput.addEventListener('focus', function(e) {
            const length = e.target.value.length;
            e.target.setSelectionRange(length, length);
        });
    });
</script>
