@extends('layouts.app')

@section('title', 'Barang Masuk')

@section('content')

<x-crud.header
    title="Barang Masuk Outlet"
    subtitle="Kelola data barang masuk outlet"
    :createRoute="route('barang-masuk.create')"
    createLabel="Tambah Barang Masuk"
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

    @forelse($barangMasuk as $item)

        <tr>

            <td class="text-center">

                {{ $barangMasuk->firstItem() + $loop->index }}

            </td>

            <td>

                {{ $item->tanggal_masuk->format('d-m-Y') }}

            </td>

            <td>

                {{ $item->kodebrg }}

            </td>

            <td>

                {{ $item->barang->namabrg }}

            </td>

            <td>

                {{ number_format($item->jumlah_masuk) }}

            </td>

            <td>

                {{ $item->satuan }}

            </td>

            <td>

                {{ $item->diinput_oleh }}

            </td>

            <td>

                <x-crud.actions

                    :edit="route('barang-masuk.edit',$item->id)"

                    :delete="route('barang-masuk.destroy',$item->id)"

                />

            </td>

        </tr>

    @empty

        <x-crud.empty
            message="Belum ada data barang masuk."
        />

    @endforelse

</x-crud.table>

<x-crud.pagination
    :data="$barangMasuk"
/>

@endsection