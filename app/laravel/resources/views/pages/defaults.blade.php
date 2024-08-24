<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/bmsys.css">
    @yield('styles')
    @stack('styles')
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>
    @yield('scripts')
    <script type="module">
    @stack('scripts')
    </script>
</head>
<!-- {{ optional($screen)->name ?? 'route名が未設定' }} -->
<body class="h-100 d-flex flex-column align-items-stretch" hidden>
@yield('body', '')
@stack('dialogs')
@stack('overwraps')
</body>
</html>
