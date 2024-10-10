<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin SWABINA GATRA</title>
<link rel="shortcut icon" type="image/png" href="https://th.bing.com/th/id/OIP.kAUISDUCtKkJbri2eOKW6gAAAA?rs=1&pid=ImgDetMain" />
<link rel="stylesheet" href="{{ asset('admin/css/styles.min.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-center">
            <a href="#" class="text-nowrap logo-img">
            {{-- <a href="{{ route('landingpage') }}" class="text-nowrap logo-img"> --}}
            <img src="https://th.bing.com/th/id/OIP.kAUISDUCtKkJbri2eOKW6gAAAA?rs=1&pid=ImgDetMain" alt="" width="50" height="50" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.dashboard')}}" aria-expanded="false">
                {{-- <a class="sidebar-link" href="{{ route('admin.dashboard') }}" aria-expanded="false"> --}}
                <span>
                    <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                <span class="hide-menu">UI COMPONENTS</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <span>
                    <iconify-icon icon="solar:layers-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Landing Page</span>
                <span class="ms-auto">
                    <iconify-icon icon="akar-icons:chevron-right" class="dropdown-icon"></iconify-icon>
                </span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                    <a href="{{ route('admin.landingpage.carousel.index') }}" class="sidebar-link">
                        <span class="hide-menu">Carousel</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('admin.landingpage.fotoLayanan.index')}}" class="sidebar-link">
                        <span class="hide-menu">Foto dan Layanan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('admin.landingpage.jejaklangkah.index')}}" class="sidebar-link">
                        <span class="hide-menu">Jejak Langkah</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('admin.landingpage.sekilas.index')}}" class="sidebar-link">
                        <span class="hide-menu">Sekilas Perusahaan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('admin.landingpage.sertifikat-penghargaan.index')}}" class="sidebar-link">
                        <span class="hide-menu">Sertifikat & Penghargaan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('admin.landingpage.visimisi.index')}}" class="sidebar-link">
                        <span class="hide-menu">Visi Misi & Budaya</span>
                    </a>
                </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow d-flex justify-content-between align-items-center" href="javascript:void(0)" aria-expanded="false">
                    <span>
                        <iconify-icon icon="solar:danger-circle-bold-duotone" class="fs-6"></iconify-icon>
                        <span class="hide-menu">Facility Management</span>
                    </span>
                    <span>
                        <iconify-icon icon="akar-icons:chevron-right" class="dropdown-icon-right"></iconify-icon>
                        <iconify-icon icon="akar-icons:chevron-down" class="dropdown-icon-down d-none"></iconify-icon>
                    </span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                        <a href="{{ route('admin.facilitymanagement.carouselFM.index') }}" class="sidebar-link">
                            <span class="hide-menu">Carousel</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.facilitymanagement.gambarFM.index') }}" class="sidebar-link">
                            <span class="hide-menu">Gambar</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.textfm.index') }}" class="sidebar-link">
                            <span class="hide-menu">Text Area</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow d-flex justify-content-between align-items-center" href="javascript:void(0)" aria-expanded="false">
                    <span>
                        <iconify-icon icon="solar:bookmark-square-minimalistic-bold-duotone" class="fs-6"></iconify-icon>
                        <span class="hide-menu">Swa Segar</span>
                    </span>
                    <span>
                        <iconify-icon icon="akar-icons:chevron-right" class="dropdown-icon-right"></iconify-icon>
                        <iconify-icon icon="akar-icons:chevron-down" class="dropdown-icon-down d-none"></iconify-icon>
                    </span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                        <a href="{{ route('admin.swasegar.carousel.index') }}" class="sidebar-link">
                            <span class="hide-menu">Carousel</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.swasegar.gambarSS.index') }}" class="sidebar-link">
                            <span class="hide-menu">Gambar</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.swasegar.textss.index') }}" class="sidebar-link">
                            <span class="hide-menu">Text</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow d-flex justify-content-between align-items-center" href="javascript:void(0)" aria-expanded="false">
                    <span>
                        <iconify-icon icon="solar:file-text-bold-duotone" class="fs-6"></iconify-icon>
                        <span class="hide-menu">Swa Tour & Organizer</span>
                    </span>
                    <span>
                        <iconify-icon icon="akar-icons:chevron-right" class="dropdown-icon-right"></iconify-icon>
                        <iconify-icon icon="akar-icons:chevron-down" class="dropdown-icon-down d-none"></iconify-icon>
                    </span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                        <a href="{{ route('admin.swatour.carouselteo.index') }}" class="sidebar-link">
                            <span class="hide-menu">Carousel</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.swatour.gambarteo.index') }}" class="sidebar-link">
                            <span class="hide-menu">Gambar</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.swatour.textteo.index') }}" class="sidebar-link">
                            <span class="hide-menu">Text</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow d-flex justify-content-between align-items-center" href="javascript:void(0)" aria-expanded="false">
                    <span>
                        <iconify-icon icon="solar:text-field-focus-bold-duotone" class="fs-6"></iconify-icon>
                        <span class="hide-menu">Digital Solution</span>
                    </span>
                    <span>
                        <iconify-icon icon="akar-icons:chevron-right" class="dropdown-icon-right"></iconify-icon>
                        <iconify-icon icon="akar-icons:chevron-down" class="dropdown-icon-down d-none"></iconify-icon>
                    </span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                        <a href="{{ route('admin.digitalsolution.carouselds.index') }}" class="sidebar-link">
                            <span class="hide-menu">Carousel</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.digitalsolution.gambards.index') }}" class="sidebar-link">
                            <span class="hide-menu">Gambar </span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.digitalsolution.textds.index') }}" class="sidebar-link">
                            <span class="hide-menu">Text</span>
                        </a>
                    </li>
                </ul>
            </li> 
            <li class="nav-small-cap">
            <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-6"></iconify-icon>
            <span class="hide-menu">AUTH</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('logout') }}" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                aria-expanded="false">
                    <span>
                        <iconify-icon icon="solar:login-3-bold-duotone" class="fs-6"></iconify-icon>
                    </span>
                    <span class="hide-menu">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
                <span>
                <iconify-icon icon="solar:user-plus-rounded-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Register</span>
            </a>
            </li>
            <li class="nav-small-cap">
            <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
            <span class="hide-menu">EXTRA</span>
            </li>
            <li class="sidebar-item">
            <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                <span>
                <iconify-icon icon="solar:sticker-smile-circle-2-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Icons</span>
                </a>
            </li>
            <li class="sidebar-item">
            <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                <span>
                <iconify-icon icon="solar:planet-3-bold-duotone" class="fs-6"></iconify-icon>
                </span>
                <span class="hide-menu">Sample Page</span>
            </a>
            </li>
        </ul>
        <div class="unlimited-access hide-menu bg-primary-subtle position-relative mb-7 mt-7 rounded-3"> 
            <div class="d-flex">
            <div class="unlimited-access-title me-3">
                <h6 class="fw-semibold fs-4 mb-6 text-dark w-75">Upgrade to pro</h6>
                <a href="#" target="_blank"
                class="btn btn-primary fs-2 fw-semibold lh-sm">Buy Pro</a>
            </div>
            <div class="unlimited-access-img">
                <img src="{{ asset('admin/images/backgrounds/rocket.png')}}" alt="" class="img-fluid">
            </div>
            </div>
        </div>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
    <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
                </a>
            </li>

            </ul>
            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                    <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                        <i class="ti ti-user fs-6"></i>
                        <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                        <i class="ti ti-mail fs-6"></i>
                        <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                        <i class="ti ti-list-check fs-6"></i>
                        <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                    </div>
                </div>
                </li>
            </ul>
        </div>
        </nav>
        </header>
        <!--  Header End -->
        <div class="container-fluid">
        @yield('content')
        </div>
    </div>
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