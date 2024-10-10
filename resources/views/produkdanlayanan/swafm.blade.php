@extends ('produkdanlayanan.main-swafm')
@section ('konten-swafm')

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

@endsection 




