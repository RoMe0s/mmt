<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config("app.name") }}</title>
        <link href="{{ mix("css/app.css") }}" rel="stylesheet" />
    </head>
    <body>
        <div id="app">
            <visits-counter></visits-counter>
            <div class="container">
                @yield("content")
            </div>
        </div>
        <script src="{{ mix("js/app.js") }}" type="text/javascript"></script>
        <script src="{{ mix("js/helpers.js") }}" type="text/javascript"></script>
    </body>
</html>
