<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin SWABINA GATRA</title>
<link rel="shortcut icon" type="image/png" href="https://th.bing.com/th/id/OIP.kAUISDUCtKkJbri2eOKW6gAAAA?rs=1&pid=ImgDetMain" />
<link rel="stylesheet" href="{{ asset('admin/css/styles.min.css') }}" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container-fluid">
    @yield('content')
</div>
    
<script src="{{ asset('admin/libs/jquery/dist/jquery.min.js')}}"> </script>
<script src="{{ asset('admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"> </script>
<script src="{{ asset('admin/libs/apexcharts/dist/apexcharts.min.js')}}"> </script>
<script src="{{ asset('admin/libs/simplebar/dist/simplebar.js')}}"> </script>
<script src="{{ asset('admin/js/sidebarmenu.js')}}"> </script>
<script src="{{ asset('admin/js/app.min.js')}}"> </script>
<script src="{{ asset('admin/js/dashboard.js')}}"> </script>
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<script>$(document).ready(function() {$('.sidebar-link.has-arrow').on('click', function() {var $this = $(this);var $submenu = $this.next('.collapse');$submenu.slideToggle(300);$this.find('.dropdown-icon').toggleClass('rotate');});});</script>
<style>
    .dropdown-icon.rotate {
    transform: rotate(90deg);
    transition: transform 0.3s;
    }
</style>
@yield('scripts')
</body>

</html>