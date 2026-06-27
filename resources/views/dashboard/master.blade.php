@extends('layouts.app')

@section('title', 'Dashboard Master')

@section('content')

<div class="container-fluid">

    <div class="row mb-4">

        <div class="col-md-4">

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

        <div class="col-md-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <small class="text-muted">

                        Total Barang Masuk

                    </small>

                    <h2 class="fw-bold text-success mb-0">

                        {{ number_format($barangMasuk) }}

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <small class="text-muted">

                        Total Barang Keluar

                    </small>

                    <h2 class="fw-bold text-danger mb-0">

                        {{ number_format($barangKeluar) }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                Stok Barang Saat Ini

            </h5>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th width="60">No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th class="text-end">Stok</th>
                        <th>Satuan</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($stok as $item)

                        <tr>

                            <td>

                                {{ $loop->iteration }}

                            </td>

                            <td>

                                {{ $item->kodebrg }}

                            </td>

                            <td>

                                {{ $item->barang->namabrg }}

                            </td>

                            <td class="text-end">

                                @if($item->stok_tersisa <= 10)

                                    <span class="badge bg-danger">

                                        {{ number_format($item->stok_tersisa) }}

                                    </span>

                                @else

                                    <span class="badge bg-success">

                                        {{ number_format($item->stok_tersisa) }}

                                    </span>

                                @endif

                            </td>

                            <td>

                                {{ $item->satuan }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center py-4">

                                Belum ada data stok.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection