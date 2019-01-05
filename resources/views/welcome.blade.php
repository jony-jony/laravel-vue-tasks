<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <title>Laravel - Vue</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  </head>
  <body>
    <div id="app">
      <h1>Laravel - Vue</h1>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
  </body>
</html>
