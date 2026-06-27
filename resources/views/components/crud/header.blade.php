@props([
    'title',
    'subtitle' => null,
    'createRoute' => null,
    'createLabel' => 'Tambah Data'
])

<div class="card shadow-sm mb-4">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div>

                <h3 class="fw-bold mb-1">

                    {{ $title }}

                </h3>

                @if($subtitle)

                    <p class="text-muted mb-0">

                        {{ $subtitle }}

                    </p>

                @endif

            </div>

            @if($createRoute)

                <a href="{{ $createRoute }}"
                   class="btn btn-primary">

                    <i class="bi bi-plus-circle me-1"></i>

                    {{ $createLabel }}

                </a>

            @endif

        </div>

    </div>

</div>