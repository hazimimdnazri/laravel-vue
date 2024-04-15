<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Vue | Login</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="hold-transition login-page" style="min-height: 100vh !important">
    <div id="app" class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ url('/') }}" class="h1">
                    <img src="{{ asset('assets/images/logo.png') }}" width="80%">
                </a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <login-component :root_url="'{{ url('/') }}'"></login-component>
                <p class="mb-0">
                    <a href="{{ url('guest/register') }}" class="text-center">Register a new membership</a>
                </p>
            </div>

        </div>
    </div>
</body>
</html>