@props([
    'message' => 'Belum ada data.'
])

<tr>

    <td colspan="100%" class="text-center py-5">

        <i class="bi bi-inbox fs-1 text-secondary"></i>

        <p class="mt-3 mb-0 text-muted">

            {{ $message }}

        </p>

    </td>

</tr>