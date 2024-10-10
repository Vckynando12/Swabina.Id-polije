@extends ('memilihkami.main-mengapa')
@section ('konten-mengapa')

<!-- Header -->
@include ('memilihkami.partial-memilihkami.header-mk')

<!-- Navigasi -->
@include ('memilihkami.partial-memilihkami.navigasi-mk')

<!-- Iki isine sekilas -->
@include ('memilihkami.partial-memilihkami.isi-memilihkami')

<!-- Footer -->
@include ('memilihkami.partial-memilihkami.footer-mk')

<!-- Floating Button-->
@include ('memilihkami.partial-memilihkami.floating-mk')

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/memilihkami.js') }}"></script>

@endsection 