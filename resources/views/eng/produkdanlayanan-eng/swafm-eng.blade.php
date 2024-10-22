<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/produklayanan.css')}}">
</head>
<body>
    <!-- Header -->
    @include ('produkdanlayanan.partial-produklayanan.header-pl')

    <!-- Navigasi -->
    @include ('produkdanlayanan.partial-produklayanan.navigasi-pl')

    <!-- Iki isine facility management -->
    @include ('produkdanlayanan.partial-produklayanan.isi-swafm')

    <!-- Footer -->
    @include ('produkdanlayanan.partial-produklayanan.footer-pl')

    <!-- Floating Button-->
    @include ('produkdanlayanan.partial-produklayanan.floating-pl')

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/produklayanan.js') }}"></script>
</body>
</html>




