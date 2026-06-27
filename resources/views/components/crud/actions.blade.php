@props([
    'edit' => null,
    'delete' => null,
    'deleteMessage' => 'Apakah Anda yakin ingin menghapus data ini?'
])

<div class="d-flex justify-content-center gap-2">

    @if($edit)

        <a href="{{ $edit }}"
           class="btn btn-warning btn-sm">

            <i class="bi bi-pencil-square"></i>

            Edit

        </a>

    @endif


    @if($delete)

        <form
            action="{{ $delete }}"
            method="POST"
            onsubmit="return confirm('{{ $deleteMessage }}')"
        >

            @csrf

            @method('DELETE')

            <button
                type="submit"
                class="btn btn-danger btn-sm">

                <i class="bi bi-trash"></i>

                Hapus

            </button>

        </form>

    @endif

</div>