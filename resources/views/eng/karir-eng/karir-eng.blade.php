<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/karir.css')}}">
</head>
<body>
    <!-- Header -->
    @include ('karir.partial-karir.header-karir')

    <!-- Navigasi -->
    @include ('karir.partial-karir.navigasi-karir')

    <!-- Iki isine sekilas -->
    @include ('karir.partial-karir.isi-karir')

    <!-- Footer -->
    @include ('karir.partial-karir.footer-karir')

    <!-- Floating Button-->
    @include ('karir.partial-karir.floating-karir')

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/karir.js') }}"></script>

</body>
</html>