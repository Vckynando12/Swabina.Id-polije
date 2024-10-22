<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visi Misi - PT Swabina Gatra</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/tentangkami.css')}}">
</head>
<body>
    <!-- Header -->
    @include ('tentangkami.partial-tentangkami.header-tk')

    <!-- Navigasi -->
    @include ('tentangkami.partial-tentangkami.navigasi-tk')

    <!-- Isi Visi Misi -->
    @include ('tentangkami.partial-tentangkami.isi-visimisi')

    <!-- Footer -->
    @include ('tentangkami.partial-tentangkami.footer-tk')

    <!-- Floating Button-->
    @include ('tentangkami.partial-tentangkami.floating-tk')

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
