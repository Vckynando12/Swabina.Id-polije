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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>.karir-item {
        border-bottom: 1px solid #eee;
        padding: 10px 0;
    }
    
    .karir-item:last-child {
        border-bottom: none;
    }
    
    .file-icon {
        margin-left: 15px;
    }
    
    .file-icon i {
        font-size: 24px;
    }</style>
</head>
<body>
    <!-- Header -->
    @include ('partial-eng.header-eng')

    <!-- Navigasi -->
    @include ('partial-eng.navigasi-eng')

    <!-- Iki isine sekilas -->
    @include ('eng.karir-eng.partial-karir.isi-karir')

    <!-- Footer -->
    @include ('partial-eng.footer-eng')

    <!-- Floating Button-->
    @include ('partial-eng.floating-eng')

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/karir.js') }}"></script>

</body>
</html>