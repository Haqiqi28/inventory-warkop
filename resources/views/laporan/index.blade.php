@extends('layouts.app')

@section('title', 'Laporan Transaksi')

@section('content')

<x-crud.header
    title="Laporan Transaksi Outlet"
    subtitle="Laporan transaksi barang masuk dan barang keluar"
/>

<x-crud.alert />

<div class="card shadow-sm mb-4">

    <div class="card-body">

        <form method="GET">

            <div class="row">

                <div class="col-md-4">

                    <label class="form-label">

                        Barang

                    </label>

                    <select
                        name="kodebrg"
                        class="form-select">

                        <option value="">

                            Semua Barang

                        </option>

                        @foreach($barang as $item)

                            <option
                                value="{{ $item->kodebrg }}"
                                @selected(request('kodebrg') == $item->kodebrg)>

                                {{ $item->namabrg }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-3">

                    <label class="form-label">

                        Tanggal Awal

                    </label>

                    <input
                        type="date"
                        name="tanggal_awal"
                        value="{{ request('tanggal_awal') }}"
                        class="form-control">

                </div>

                <div class="col-md-3">

                    <label class="form-label">

                        Tanggal Akhir

                    </label>

                    <input
                        type="date"
                        name="tanggal_akhir"
                        value="{{ request('tanggal_akhir') }}"
                        class="form-control">

                </div>

                <div
                    class="col-md-2 d-flex align-items-end">

                    <button
                        class="btn btn-primary w-100">

                        Filter

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<x-crud.table
    :headers="[
        'No',
        'Tanggal',
        'Kode',
        'Nama Barang',
        'Masuk',
        'Keluar',
        'Sisa',
        'Satuan',
        'Diinput Oleh'
    ]">

    @forelse($laporan as $item)

        <tr>

            <td class="text-center">

                {{ $laporan->firstItem() + $loop->index }}

            </td>

            <td>

                {{ $item->tanggal->format('d-m-Y') }}

            </td>

            <td>

                {{ $item->kodebrg }}

            </td>

            <td>

                {{ $item->barang->namabrg }}

            </td>

            <td class="text-success fw-bold">

                {{ number_format($item->masuk) }}

            </td>

            <td class="text-danger fw-bold">

                {{ number_format($item->keluar) }}

            </td>

            <td class="fw-bold">

                {{ number_format($item->sisa) }}

            </td>

            <td>

                {{ $item->satuan }}

            </td>

            <td>

                {{ $item->diinput_oleh }}

            </td>

        </tr>

    @empty

        <x-crud.empty
            message="Belum ada data laporan."
        />

    @endforelse

</x-crud.table>

<x-crud.pagination
    :data="$laporan"
/>

@endsection