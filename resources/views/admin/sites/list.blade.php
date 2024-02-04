<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site List</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body>
    <div class="container mx-auto my-8 max-w-4xl">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-center">Sites List</h2>
            <button onclick="openModal()"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create</button>
        </div>

        <div id="no-data" class="hidden text-center py-4 my-4 bg-red-100 text-red-700">
            No data available at the moment.
        </div>
        <table class="text-center table-auto w-full mx-auto" id="sites-table">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-center">URL</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
            </tbody>
        </table>
    </div>
    @include('admin.sites.components.modalCreate');
</body>

</html>

<script src="{{ asset('js/sites/app.js') }}"></script>
<script>
    const sites = @json($sites);
    if (sites.length === 0) {
        document.getElementById('no-data').classList.remove('hidden');
    } else {
        const tbody = document.getElementById('sites-table').getElementsByTagName('tbody')[0];
        sites.forEach(site => {
            let row = tbody.insertRow();
            let url = row.insertCell(0);
            let action = row.insertCell(1);

            url.innerHTML = site.url;
            action.innerHTML = `
                    <div class="inline-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 hover:text-blue-700 cursor-pointer mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" title="Editar">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 4.232a1.5 1.5 0 00-2.121 0l-6.899 6.899a1 1 0 00-.263.464l-1.414 5.657a1 1 0 001.263 1.263l5.657-1.414a1 1 0 00.464-.263l6.899-6.899a1.5 1.5 0 000-2.121l-2.121-2.121z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 15.5H8v.5h-.5v-.5zm4-4H12v.5h-.5v-.5z"/>
                        </svg>
                          <svg xmlns="http://www.w3.org/2000/svg" class="delete-icon h-6 w-6 text-red-500 hover:text-red-700 cursor-pointer" data-id="${site.id}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" title="Excluir">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>`;
        });
    }
    // Delete Site
    document.querySelectorAll('.delete-icon').forEach(icon => {
        icon.addEventListener('click', function() {
            const siteId = this.getAttribute('data-id');

            axios.delete(`{{ url('admin/sites') }}/${siteId}`)
                .then(function(response) {
                    window.location.reload();
                })
                .catch(function(error) {
                    console.error('Erro ao excluir o site:', error);
                });
        });
    });

    // Send Site for Creation 
    document.getElementById('add-site-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const url = document.getElementById('site-url').value;
        axios.post('{{ route('admin.sites.store') }}', {
                url: url
            })
            .then(function(response) {
                closeModal();
                window.location.reload();
            })
            .catch(function(error) {
                const errorMessageDiv = document.getElementById('error-message');
                errorMessageDiv.innerText = 'Erro ao adicionar o site. Tente novamente.';
                errorMessageDiv.classList.remove('hidden');
                console.error(error);
            });
    });
</script>
