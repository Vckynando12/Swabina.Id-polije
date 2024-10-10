@extends ('karir.main-karir')
@section ('konten-karir')

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

@endsection 