<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <title>Laravel</title>
    </head>
    <body>
        <div id="app">
            <!-- component matched by the Vue.js router will render here -->
            <router-view></router-view>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
