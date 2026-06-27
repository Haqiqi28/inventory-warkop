@props([
    'data'
])

@if($data->hasPages())

    <div class="d-flex justify-content-between align-items-center mt-3">

        <div class="text-muted small">

            Menampilkan

            <strong>{{ $data->firstItem() }}</strong>

            -

            <strong>{{ $data->lastItem() }}</strong>

            dari

            <strong>{{ $data->total() }}</strong>

            data

        </div>

        <div>

            {{ $data->links() }}

        </div>

    </div>

@endif