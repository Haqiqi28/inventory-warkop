@extends('layouts.guest')

@section('title', 'Login')

@section('content')

<div class="text-center mb-4">

    <h3 class="fw-bold">

        WARKOP APGRET

    </h3>

    <p class="text-muted mb-0">

        Silakan login untuk melanjutkan

    </p>

</div>

@if(session('status'))

    <div class="alert alert-success">

        {{ session('status') }}

    </div>

@endif

<form method="POST" action="{{ route('login') }}">

    @csrf

    <div class="mb-3">

        <label class="form-label">

            Username

        </label>

        <input
            type="text"
            name="username"
            value="{{ old('username') }}"
            class="form-control @error('username') is-invalid @enderror"
            required
            autofocus>

        @error('username')

            <div class="invalid-feedback">

                {{ $message }}

            </div>

        @enderror

    </div>

    <div class="mb-3">

        <label class="form-label">

            Password

        </label>

        <input
            type="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
            required>

        @error('password')

            <div class="invalid-feedback">

                {{ $message }}

            </div>

        @enderror

    </div>

    <div class="form-check mb-4">

        <input
            class="form-check-input"
            type="checkbox"
            name="remember"
            id="remember">

        <label
            class="form-check-label"
            for="remember">

            Remember Me

        </label>

    </div>

    <button
        class="btn btn-primary w-100">

        Login

    </button>

</form>

@endsection