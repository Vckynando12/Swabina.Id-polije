@extends ('berita.main-berita')
@section ('konten-berita')

<!-- Header -->
@include ('berita.partial-berita.header-berita')

<!-- Navigasi -->
@include ('berita.partial-berita.navigasi-berita')

<!-- Iki isine sekilas -->
@include ('berita.partial-berita.isi-berita')

<!-- Footer -->
@include ('berita.partial-berita.footer-berita')

<!-- Floating Button-->
@include ('berita.partial-berita.floating-berita')

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/berita.js') }}"></script>

@endsection 