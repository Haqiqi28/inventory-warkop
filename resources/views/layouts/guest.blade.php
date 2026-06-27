<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}">

    <title>

        @yield('title', config('app.name'))

    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center align-items-center min-vh-100">

        <div class="col-lg-4 col-md-6">

            <div class="card shadow border-0">

                <div class="card-body p-4">

                    @yield('content')

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>