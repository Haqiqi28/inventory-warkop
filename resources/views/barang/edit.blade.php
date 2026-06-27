@extends('layouts.app')

@section('content')

<div class="container">

<h3>Edit Barang</h3>

<form action="{{ route('barang.update',$barang) }}" method="POST">

@csrf
@method('PUT')

@include('barang.form')

<button class="btn btn-warning">

Update

</button>

</form>

</div>

@endsection