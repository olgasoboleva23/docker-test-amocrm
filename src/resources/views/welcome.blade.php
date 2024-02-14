<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>amoCRM test</title>
        @vite('resources/css/app.css')
        <script>
            window.token = '{{ csrf_token() }}';
        </script>
    </head>
    <body>
      <div id="app"></div>
      @vite('resources/js/app.js')
    </body>
</html>
