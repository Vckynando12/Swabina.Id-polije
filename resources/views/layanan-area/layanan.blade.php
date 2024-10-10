@extends ('layanan-area.main-layanan')
@section ('konten-layanan')

<!-- Header -->
@include ('layanan-area.partial-layanan.header-layanan')

<!-- Navigasi -->
@include ('layanan-area.partial-layanan.navigasi-layanan')

<!-- Iki isine sekilas -->
@include ('layanan-area.partial-layanan.isi-layanan')

<!-- Footer -->
@include ('layanan-area.partial-layanan.footer-layanan')

<!-- Floating Button-->
@include ('layanan-area.partial-layanan.floating-layanan')

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/layanan-area.js') }}"></script>

@endsection 