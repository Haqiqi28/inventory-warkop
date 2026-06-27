@extends('layouts.app')

@section('title', 'Tambah Barang Masuk')

@section('content')

<x-crud.header
    title="Tambah Barang Masuk"
    subtitle="Input data barang masuk outlet"
/>

<x-crud.alert />

<div class="card shadow-sm">

    <div class="card-body">

        <form
            action="{{ route('barang-masuk.store') }}"
            method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">

                    Barang

                    <span class="text-danger">*</span>

                </label>

                <select
                    name="kodebrg"
                    id="kodebrg"
                    class="form-select @error('kodebrg') is-invalid @enderror"
                    required>

                    <option value="">

                        -- Pilih Barang --

                    </option>

                    @foreach($barang as $item)

                        <option
                            value="{{ $item->kodebrg }}"
                            data-satuan="{{ $item->satuan }}"
                            {{ old('kodebrg') == $item->kodebrg ? 'selected' : '' }}>

                            {{ $item->kodebrg }} - {{ $item->namabrg }}

                        </option>

                    @endforeach

                </select>

                @error('kodebrg')

                    <div class="invalid-feedback">

                        {{ $message }}

                    </div>

                @enderror

            </div>

            <x-form.input
                name="jumlah_masuk"
                label="Jumlah Masuk"
                type="number"
                required
            />

            <x-form.input
                name="satuan"
                label="Satuan"
                required
                readonly
            />

            <x-form.input
                name="tanggal_masuk"
                label="Tanggal Masuk"
                type="date"
                :value="date('Y-m-d')"
                required
            />

            <div class="d-flex justify-content-end gap-2">

                <x-form.button
                    href="{{ route('barang-masuk.index') }}"
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

@push('js')

<script>

document.addEventListener('DOMContentLoaded', function(){

    const barang = document.getElementById('kodebrg');

    const satuan = document.getElementById('satuan');

    function loadSatuan(){

        let selected = barang.options[barang.selectedIndex];

        satuan.value = selected.dataset.satuan ?? '';

    }

    barang.addEventListener('change', loadSatuan);

    loadSatuan();

});

</script>

@endpush