<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- logo -->
    <link rel="icon" href="{{ asset('logo.png') }}">
    <title>@yield('title',config('app.name', 'Laravel')) </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="http://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        window.CKEDITOR || document.write('<script src="/vendor/ckeditor/ckeditor.js"/>')
    </script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script src="https://kit.fontawesome.com/480673436b.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <main class="d-flex flex-wrap" id="main-wrapper">
        <x-navbar />
        <x-sidebar />
        <section class="w-100 content-margin">

            <x-breadcrumbs :title="$title" />
            <x-success-message />
            <section class="pt-3 mb-2 page-content">
                @yield('content')
            </section>
        </section>
    </main>
</body>

</html>
