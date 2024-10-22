<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Berita - PT Swabina Gatra</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/berita.css')}}">
</head>
<body>
    <!-- Header -->
    @include ('berita.partial-berita.header-berita')

    <!-- Navigasi -->
    @include ('berita.partial-berita.navigasi-berita')

    <!-- Iki isine sekilas -->
    @include ('berita.partial-berita.isi-berita')

    <!-- Footer -->
    @include ('berita.partial-berita.footer-berita')

    <!-- Floating Button-->
    @include ('berita.partial-berita.floating-berita')

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/berita.js') }}"></script>
</body>
</html>
