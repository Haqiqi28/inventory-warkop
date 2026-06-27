@extends('layouts.app')

@section('content')

<div class="container">

<h3>Tambah Barang</h3>

<form action="{{ route('barang.store') }}" method="POST">

@csrf

@include('barang.form')

<button class="btn btn-primary">

Simpan

</button>

</form>

</div>

@endsection