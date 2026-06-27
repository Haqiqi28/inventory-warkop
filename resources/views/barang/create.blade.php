@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('content')

<x-crud.header
    title="Tambah Barang"
    subtitle="Tambah data barang baru"
/>

<x-crud.alert />

<div class="card shadow-sm">

    <div class="card-body">

        <form
            action="{{ route('barang.store') }}"
            method="POST">

            @csrf

            <x-form.input
                name="kodebrg"
                label="Kode Barang"
                required
            />

            <x-form.input
                name="namabrg"
                label="Nama Barang"
                required
            />

            <x-form.select
                name="kategori"
                label="Kategori"
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
                required
            />

            <x-form.input
                name="harga"
                label="Harga"
                type="number"
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
                    icon="check-circle">

                    Simpan

                </x-form.button>

            </div>

        </form>

    </div>

</div>

@endsection