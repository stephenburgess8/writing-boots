<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Writing Boots') }}</title>
</head>
<body>
    <div class="wdi-window" id="app">
        <div class="wdi-header--sticky">
            @include('partials.header')
        </div>
        <div class="wdi-body--sticky">
            <main>
                @yield('content')
            </main>
        </div>
        <div class="wdi-footer--sticky">
            @include('partials.footer')
        </div>
    </div>
</body>
</html>
