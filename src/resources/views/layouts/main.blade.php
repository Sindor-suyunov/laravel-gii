<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>@yield('title')</title>
    @livewireStyles
</head>
<body class="bg-dark">
<div class="row m-0">
    <div class="col-md-12">
        <nav class="navbar bg-dark border-bottom text-white border-body" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/gii">Laravel Gii</a>
                <a class="nav-link" href="/">Home</a>
            </div>
        </nav>
    </div>
</div>
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-3">
            @include('gii::layouts.sidebar')
        </div>
        <div class="col-md-9">
            <div class="row text-white mb-4 h4">
                @yield('title')
            </div>
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>

@livewireScripts
</body>
</html>
