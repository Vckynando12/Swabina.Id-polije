<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sertifikat - PT Swabina Gatra</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/tentangkami.css')}}">
</head>
<body>
    <!-- Header -->
    @include ('partial-eng.header-eng')

    <!-- Navigasi -->
    @include ('partial-eng.navigasi-eng')

    <!-- Isi Sertifikat -->
    @include ('eng.tentangkami-eng.partial-tentangkami.isi-sertifikat')

    <!-- Footer -->
    @include ('partial-eng.footer-eng')

    <!-- Floating Button-->
    @include ('partial-eng.floating-eng')

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/tentangkami.js') }}"></script>
</body>
</html>
