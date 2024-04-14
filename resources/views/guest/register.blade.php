<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Vue | Registration</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="hold-transition register-page">
    <div id="app" class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ url('/') }}" class="h1"><b>Laravel</b>Vue</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>
                <register-component :root_url="'{{ url('/') }}'"></register-component>
                <a href="{{ url('guest/login') }}" class="text-center">I already have a membership</a>
            </div>

        </div>
    </div>
</body>

</html>