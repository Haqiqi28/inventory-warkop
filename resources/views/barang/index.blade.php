@extends('layouts.app')

@section('title', 'Master Barang')

@section('content')

<x-crud.header
    title="Master Barang"
    subtitle="Kelola seluruh data barang"
    :createRoute="route('barang.create')"
    createLabel="Tambah Barang"
/>

<x-crud.alert />

<x-crud.table
    :headers="[
        'No',
        'Kode Barang',
        'Nama Barang',
        'Kategori',
        'Satuan',
        'Harga',
        'Aksi'
    ]">

    @forelse($barang as $item)

        <tr>

            <td class="text-center">

                {{ $barang->firstItem() + $loop->index }}

            </td>

            <td>

                {{ $item->kodebrg }}

            </td>

            <td>

                {{ $item->namabrg }}

            </td>

            <td>

                {{ $item->kategori }}

            </td>

            <td>

                {{ $item->satuan }}

            </td>

            <td>

                Rp {{ number_format($item->harga,0,',','.') }}

            </td>

            <td>

                <x-crud.actions

                    :edit="route('barang.edit',$item->kodebrg)"

                    :delete="route('barang.destroy',$item->kodebrg)"

                />

            </td>

        </tr>

    @empty

        <x-crud.empty
            message="Belum ada data barang."
        />

    @endforelse

</x-crud.table>

<x-crud.pagination
    :data="$barang"
/>

@endsection