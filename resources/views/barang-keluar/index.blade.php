@extends('layouts.app')

@section('title', 'Barang Keluar')

@section('content')

<x-crud.header
    title="Barang Keluar Outlet"
    subtitle="Kelola data barang keluar outlet"
    :createRoute="route('barang-keluar.create')"
    createLabel="Tambah Barang Keluar"
/>

<x-crud.alert />

<x-crud.table
    :headers="[
        'No',
        'Tanggal',
        'Kode',
        'Nama Barang',
        'Jumlah',
        'Satuan',
        'Diinput Oleh',
        'Aksi'
    ]">

    @forelse($barangKeluar as $item)

        <tr>

            <td class="text-center">

                {{ $barangKeluar->firstItem() + $loop->index }}

            </td>

            <td>

                {{ $item->tanggal_keluar->format('d-m-Y') }}

            </td>

            <td>

                {{ $item->kodebrg }}

            </td>

            <td>

                {{ $item->barang->namabrg }}

            </td>

            <td>

                {{ number_format($item->jumlah_keluar) }}

            </td>

            <td>

                {{ $item->satuan }}

            </td>

            <td>

                {{ $item->diinput_oleh }}

            </td>

            <td>

                <x-crud.actions
                    :edit="route('barang-keluar.edit', $item->id)"
                    :delete="route('barang-keluar.destroy', $item->id)"
                />

            </td>

        </tr>

    @empty

        <x-crud.empty
            message="Belum ada data barang keluar."
        />

    @endforelse

</x-crud.table>

<x-crud.pagination
    :data="$barangKeluar"
/>

@endsection