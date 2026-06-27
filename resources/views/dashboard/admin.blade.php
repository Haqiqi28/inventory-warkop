@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="container-fluid">

    <div class="row mb-4">

        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <small class="text-muted">

                        Total Barang

                    </small>

                    <h2 class="fw-bold mb-0">

                        {{ number_format($totalBarang) }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <small class="text-muted">

                        Barang Masuk Hari Ini

                    </small>

                    <h2 class="fw-bold text-success mb-0">

                        {{ number_format($barangMasukHariIni) }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <small class="text-muted">

                        Barang Keluar Hari Ini

                    </small>

                    <h2 class="fw-bold text-danger mb-0">

                        {{ number_format($barangKeluarHariIni) }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <small class="text-muted">

                        Stok Menipis

                    </small>

                    <h2 class="fw-bold text-warning mb-0">

                        {{ number_format($stokMenipis) }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                Transaksi Terbaru

            </h5>

        </div>

        <div class="card-body p-0">

            <table class="table table-hover mb-0">

                <thead>

                    <tr>

                        <th>Tanggal</th>

                        <th>Kode</th>

                        <th>Barang</th>

                        <th>Masuk</th>

                        <th>Keluar</th>

                        <th>Sisa</th>

                        <th>User</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($transaksiTerbaru as $item)

                        <tr>

                            <td>

                                {{ $item->tanggal->format('d-m-Y') }}

                            </td>

                            <td>

                                {{ $item->kodebrg }}

                            </td>

                            <td>

                                {{ $item->barang->namabrg }}

                            </td>

                            <td class="text-success">

                                {{ number_format($item->masuk) }}

                            </td>

                            <td class="text-danger">

                                {{ number_format($item->keluar) }}

                            </td>

                            <td>

                                {{ number_format($item->sisa) }}

                            </td>

                            <td>

                                {{ $item->diinput_oleh }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-4">

                                Belum ada transaksi.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection