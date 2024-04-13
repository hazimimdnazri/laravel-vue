<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Veu | Dashboard</title>
    @vite(['resources/css/app.css'])
</head>

<body class="hold-transition sidebar-mini">
    <div id="app" class="wrapper">
        <topbar-component></topbar-component>
        <sidebar-component :user_name="'{{ auth()->user()->name }}'" :root_url="'{{ url('/') }}'" :_token="'{{ csrf_token() }}'"></sidebar-component>

        <div class="content-wrapper">
            @yield('content')
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
</body>
@vite('resources/js/app.js')
</html>