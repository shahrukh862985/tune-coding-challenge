<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Coding Challenge</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
    </head>
    <body class="dx-viewport">
        <div id="app">
            <main-component></main-component>
        </div>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>