@extends ('tentangkami.main-visimisi')
@section ('konten-visimisi')

<!-- Header -->
@include ('tentangkami.partial-tentangkami.header-tk')

<!-- Navigasi -->
@include ('tentangkami.partial-tentangkami.navigasi-tk')

<!-- Iki isine sekilas -->
@include ('tentangkami.partial-tentangkami.isi-visimisi')

<!-- Footer -->
@include ('tentangkami.partial-tentangkami.footer-tk')

<!-- Floating Button-->
@include ('tentangkami.partial-tentangkami.floating-tk')

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/tentangkami.js') }}"></script>

@endsection 




