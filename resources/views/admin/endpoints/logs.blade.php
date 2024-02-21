<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Monitor List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body class="bg-gray-100">
    @include('layouts.navigation')
    <div class="container mx-auto my-8 max-w-4xl">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Logs for <span id="endpoint-name"></span></h2>

            <button onclick="goBack()"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Return</button>

        </div>

        @component('components.table-layout', ['tableId' => 'logs-table'])
            @slot('headers')
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Response</th>
            @endslot
        @endcomponent

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div id="no-data" class="hidden text-center py-4 my-4">No data available at the moment.</div>
        </div>
    </div>

</body>

<script>
    /*  LIST LOGS */
    /*  LIST LOGS */
    const logsData = @json($logs);
    const logs = (typeof logsData === 'string') ? JSON.parse(logsData) : logsData;

    // Definir o nome do endpoint no título
    if (logs.endpoint) {
        document.getElementById('endpoint-name').textContent = logs.endpoint;
    }

    if (logs.checks && Array.isArray(logs.checks)) {
        const tbody = document.getElementById('logs-table').getElementsByTagName('tbody')[0];

        logs.checks.forEach(check => {
            let row = tbody.insertRow();
            let status = row.insertCell(0);
            status.textContent = check.status_code;
            let response = row.insertCell(1);

            if (check.status_code !== 200) {
                response.textContent = 'Error - Click to view details';
                response.style.cursor = 'pointer';
                response.onclick = () => alert(check.response_body);
            } else {
                response.textContent = check.response_body;
            }
        });

        if (tbody.rows.length === 0) {
            document.getElementById('no-data').classList.remove('hidden');
        }
    } else {
        console.error("logs.checks is not an array or does not exist", logs);
    }

    function goBack() {
        window.history.back();
    }






    function goBack() {
        window.history.back();
    }
</script>

</html>
