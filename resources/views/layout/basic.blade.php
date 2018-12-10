<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Blog</title>
        @include('layout.assets')

        <style type="text/css">
            html, body {
                height: 100%;
            }
            body {
                display: flex;
                flex-direction: column;
            }
            .wrap_content {
                flex-grow: 1;
            }
        </style>

    </head>
    <body>
        @include('layout.header')
        <div class="wrap_content">
            <div class="container">
                @yield('content')
            </div>
        </div>
        @include('layout.footer')
    </body>
</html>
