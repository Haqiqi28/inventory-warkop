@extends('layouts.app')

@section('title', 'Edit Barang Masuk')

@section('content')

<x-crud.header
    title="Edit Barang Masuk"
    subtitle="Ubah data barang masuk outlet"
/>

<x-crud.alert />

<div class="card shadow-sm">

    <div class="card-body">

        <form
            action="{{ route('barang-masuk.update', $barangMasuk->id) }}"
            method="POST">

            @csrf
            @method('PUT')

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
                            {{ old('kodebrg', $barangMasuk->kodebrg) == $item->kodebrg ? 'selected' : '' }}>

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
                :value="$barangMasuk->jumlah_masuk"
                required
            />

            <x-form.input
                name="satuan"
                label="Satuan"
                :value="$barangMasuk->satuan"
                readonly
                required
            />

            <x-form.input
                name="tanggal_masuk"
                label="Tanggal Masuk"
                type="date"
                :value="$barangMasuk->tanggal_masuk->format('Y-m-d')"
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
                    variant="warning"
                    icon="pencil-square">

                    Update

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

        const selected = barang.options[barang.selectedIndex];

        satuan.value = selected.dataset.satuan ?? '';

    }

    barang.addEventListener('change', loadSatuan);

    loadSatuan();

});

</script>

@endpush