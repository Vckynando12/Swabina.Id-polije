@extends ('kontak.main-kontak')
@section ('konten-kontak')

<!-- Header -->
@include ('kontak.partial-kontak.header-kontak')

<!-- Navigasi -->
@include ('kontak.partial-kontak.navigasi-kontak')

<!-- Iki isine sekilas -->
@include ('kontak.partial-kontak.isi-kontak')

<!-- Footer -->
@include ('kontak.partial-kontak.footer-kontak')

<!-- Floating Button-->
@include ('kontak.partial-kontak.floating-kontak')

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/kontak.js') }}"></script>

@endsection 