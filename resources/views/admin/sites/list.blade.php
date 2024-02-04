<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mx-auto my-8">
        <h2 class="text-2xl font-bold mb-4">Sites List</h2>
        <div id="no-data" class="hidden text-center py-4 my-4 bg-red-100 text-red-700">
            No data available at the moment.
        </div>
        <table class="table-auto w-full" id="sites-table">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">URL</th>
                    <th class="py-3 px-6 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <!-- Data will be populated here -->
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        axios.get('{{ route('admin.sites.list') }}')
            .then(function(response) {
                console.log(response)
                const sites = response.data;
                if (sites.length === 0) {
                    document.getElementById('no-data').classList.remove('hidden');
                } else {
                    const tbody = document.getElementById('sites-table').getElementsByTagName('tbody')[0];
                    sites.forEach(site => {
                        let row = tbody.insertRow();
                        let id = row.insertCell(0);
                        let name = row.insertCell(1);
                        let url = row.insertCell(2);
                        let action = row.insertCell(3);

                        id.innerHTML = site.id;
                        name.innerHTML = site.name;
                        url.innerHTML = site.url;
                        action.innerHTML =
                            '<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>';
                    });
                }
            })
            .catch(function(error) {
                console.log(error);
            });
    </script>
</body>

</html>
