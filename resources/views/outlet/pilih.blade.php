@extends('layouts.app')

@section('content')

<div class="container">

<h3>Pilih Outlet</h3>

<div class="row">

@foreach($outlets as $outlet)

<div class="col-md-4">

<div class="card mb-3">

<div class="card-body">

<h5>{{ $outlet->nama }}</h5>

<p>{{ $outlet->alamat }}</p>

<a
href="{{ route('laporan.outlet',$outlet->id) }}"
class="btn btn-primary">

Pilih

</a>

</div>

</div>

</div>

@endforeach

</div>

</div>

@endsection