<!-- MASTER LAYOUT -->
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{URL::asset('css/stylesheet.css')}}">
</head>
<body class="main-body">
    @include('shared.header')
    @include('shared.navbar')
    <div class="container">
        @yield('body')

    </div>

</body>



</html>