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
            <button onclick="openModal()"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create</button>
        </div>

        @component('components.table-layout', ['tableId' => 'sites-table'])
            @slot('headers')
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
            @endslot
        @endcomponent

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div id="no-data" class="hidden text-center py-4 my-4">No data available at the moment.</div>
        </div>
    </div>
    @include('admin.sites.components.modal-create')
    @include('admin.sites.components.modal-confirm-delete')
    @include('admin.sites.components.modal-edit')
</body>

<script src="{{ asset('js/sites/app.js') }}"></script>
<script>
    /*  LIST SITE */

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
            action.innerHTML =
                `<div class="inline-flex">
                  <a href="/admin/sites/${site.id}/endpoints" title="View Endpoints">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 hover:text-green-700 cursor-pointer mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.5 14l5 5m-11-5a7 7 0 1114 0 7 7 0 01-14 0z" />
                    </svg>
                    </a>
               <svg xmlns="http://www.w3.org/2000/svg" class="edit-icon h-6 w-6 text-blue-500 hover:text-blue-700 cursor-pointer mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" title="Editar" data-id="${site.id}" data-url="${site.url}">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 4.232a1.5 1.5 0 00-2.121 0l-6.899 6.899a1 1 0 00-.263.464l-1.414 5.657a1 1 0 001.263 1.263l5.657-1.414a1 1 0 00.464-.263l6.899-6.899a1.5 1.5 0 000-2.121l-2.121-2.121z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 15.5H8v.5h-.5v-.5zm4-4H12v.5h-.5v-.5z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="delete-icon h-6 w-6 text-red-500 hover:text-red-700 cursor-pointer" data-id="${site.id}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" title="Excluir">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
              </div>`;
        });
    }

    /*  REMOVE SITE */

    document.querySelectorAll('.delete-icon').forEach(icon => {
        icon.addEventListener('click', function() {
            const uuid = this.getAttribute('data-id');
            openDeleteModal(uuid);
        });
    });

    function confirmDelete(uuid) {
        axios.delete(`{{ url('admin/site') }}/${uuid}`)
            .then(function(response) {
                window.location.reload();
            })
            .catch(function(error) {
                console.error('Error when action delete occured:', error);
            });
        closeDeleteModal();
    }

    /*  CREATE SITE */

    document.getElementById('add-site-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const url = document.getElementById('site-url').value;
        axios.post('{{ route('admin.site.store') }}', {
                url: url
            })
            .then(function(response) {
                closeModal();
                window.location.reload();
            })
            .catch(function(error) {
                const errorMessageDiv = document.getElementById('error-message');
                errorMessageDiv.innerText = 'Error adding site. Please try again.';
                errorMessageDiv.classList.remove('hidden');
                console.error(error);
            });
    });

    /*  EDIT SITE */

    function updateSite(siteUuid) {
        const siteUrl = document.getElementById('edit-site-url').value;

        axios.put(`{{ url('admin/site') }}/${siteUuid}`, {
                url: siteUrl
            })
            .then(function(response) {
                closeEditModal();
                window.location.reload();
            })
            .catch(function(error) {
                const errorMessageDiv = document.getElementById('error-message');
                errorMessageDiv.innerText = 'Error update site. Please try again.';
                errorMessageDiv.classList.remove('hidden');
                console.error(error);
            });
    }

    document.querySelectorAll('.edit-icon').forEach(icon => {
        icon.addEventListener('click', function() {
            const siteUuid = this.getAttribute('data-id');
            const siteUrl = this.getAttribute('data-url');
            openEditModal(siteUrl, siteUuid);
        });
    });
</script>

</html>
