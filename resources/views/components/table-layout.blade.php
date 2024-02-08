<!-- resources/views/components/table-layout.blade.php -->
<table class="min-w-full divide-y divide-gray-200" id="{{ $tableId }}">
    <thead class="bg-gray-50">
        <tr>
            {!! $headers !!}
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200 text-center">
        {{ $slot }}
    </tbody>
</table>
