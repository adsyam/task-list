<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 10 Task List App</title>
    @yield('styles')
</head>

<body>
    <h1>@yield('title')</h1>
    <div>
        {{-- has() lets you check if certain variables exist inside the session --}}
        @if (session()->has('success'))
            <div>{{ session('success') }}</div>
            {{-- call the session function w/ the name of the variable--}}
        @endif
        @yield('content')
    </div>
</body>

</html>
