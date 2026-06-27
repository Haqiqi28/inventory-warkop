@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')

<x-crud.header
    title="Edit Barang"
    subtitle="Ubah data barang"
/>

<x-crud.alert />

<div class="card shadow-sm">

    <div class="card-body">

        <form
            action="{{ route('barang.update', $barang->kodebrg) }}"
            method="POST">

            @csrf
            @method('PUT')

            <x-form.input
                name="kodebrg"
                label="Kode Barang"
                :value="$barang->kodebrg"
                readonly
                required
            />

            <x-form.input
                name="namabrg"
                label="Nama Barang"
                :value="$barang->namabrg"
                required
            />

            <x-form.select
                name="kategori"
                label="Kategori"
                :value="$barang->kategori"
                required
                :options="[
                    'Bahan Baku' => 'Bahan Baku',
                    'Minuman' => 'Minuman',
                    'Makanan' => 'Makanan'
                ]"
            />

            <x-form.input
                name="satuan"
                label="Satuan"
                :value="$barang->satuan"
                required
            />

            <x-form.input
                name="harga"
                label="Harga"
                type="number"
                :value="$barang->harga"
                required
            />

            <div class="d-flex justify-content-end gap-2">

                <x-form.button
                    href="{{ route('barang.index') }}"
                    variant="secondary"
                    icon="arrow-left">

                    Kembali

                </x-form.button>

                <x-form.button
                    variant="warning"
                    icon="pencil-square">

                    Update

                </x-form.button>

            </div>

        </form>

    </div>

</div>

@endsection