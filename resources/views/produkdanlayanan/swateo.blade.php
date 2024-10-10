@extends ('produkdanlayanan.main-swateo')
@section ('konten-swateo')

<!-- Header -->
@include ('produkdanlayanan.partial-produklayanan.header-pl')

<!-- Navigasi -->
@include ('produkdanlayanan.partial-produklayanan.navigasi-pl')

<!-- Iki isine ftour and event organizer -->
@include ('produkdanlayanan.partial-produklayanan.isi-swateo')

<!-- Footer -->
@include ('produkdanlayanan.partial-produklayanan.footer-pl')

<!-- Floating Button-->
@include ('produkdanlayanan.partial-produklayanan.floating-pl')

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/produklayanan.js') }}"></script>

@endsection 




