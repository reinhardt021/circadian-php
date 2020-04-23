<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src='https://use.fontawesome.com/releases/v5.3.1/js/all.js' defer></script>
</head>
<body>
    <div class="content" id="app-timer">
        <h2>{{ $title }}</h2>
        <div id="timer"></div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
