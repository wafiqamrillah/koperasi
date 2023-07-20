<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts._head')

<body class="hold-transition login-page">

    <div class="login-box">
        <div class="login-logo">
            <a href="/">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        @yield('content')
    </div>

</body>

</html>
