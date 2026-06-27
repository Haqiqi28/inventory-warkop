@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show shadow-sm">

        <div class="d-flex align-items-center">

            <i class="bi bi-check-circle-fill me-2 fs-5"></i>

            <div>

                {{ session('success') }}

            </div>

        </div>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>

@endif


@if(session('error'))

    <div class="alert alert-danger alert-dismissible fade show shadow-sm">

        <div class="d-flex align-items-center">

            <i class="bi bi-x-circle-fill me-2 fs-5"></i>

            <div>

                {{ session('error') }}

            </div>

        </div>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>

@endif


@if(session('warning'))

    <div class="alert alert-warning alert-dismissible fade show shadow-sm">

        <div class="d-flex align-items-center">

            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>

            <div>

                {{ session('warning') }}

            </div>

        </div>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>

@endif


@if(session('info'))

    <div class="alert alert-info alert-dismissible fade show shadow-sm">

        <div class="d-flex align-items-center">

            <i class="bi bi-info-circle-fill me-2 fs-5"></i>

            <div>

                {{ session('info') }}

            </div>

        </div>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>

@endif


@if($errors->any())

    <div class="alert alert-danger shadow-sm">

        <div class="d-flex align-items-start">

            <i class="bi bi-exclamation-octagon-fill me-2 fs-5"></i>

            <div>

                <strong>
                    Terjadi kesalahan:
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        </div>

    </div>

@endif