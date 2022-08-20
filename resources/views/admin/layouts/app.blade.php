<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page | Yoedu Study Network</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('mazer/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ url('mazer/assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ url('mazer/assets/vendors/choices.js/choices.min.css') }}" />
    <link rel="stylesheet" href="{{ url('mazer/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ url('mazer/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ url('mazer/assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ url('mazer/assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('mazer/assets/vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ url('catalog/css/custom.css') }}">
    <link rel="stylesheet" href="{{ url('css/ppdb.css') }}">
    <link rel="stylesheet" href="{{ url('mazer/assets/vendors/summernote/summernote-lite.min.css') }}">
    <link rel="stylesheet" href="{{ url('mazer/assets/vendors/toastify/toastify.css') }}">
    <link rel="stylesheet" href="{{ url('catalog/css/custom.css') }}">
    <link rel="stylesheet" href="{{ url('catalog/css/mobile-view.css') }}">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.js">
    <link rel="shortcut icon" href="{{ url('admin/images/favicon.png') }}" type="image/x-icon" />


    @yield('css')
    <style>
        .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #ea342a;
            border-color: #ea342a;
        }

        .btn-danger {
            background-color: #E5352B;
            border-color: #E5352B;
        }

        element.style {}

        *,
        :after,
        :before {
            box-sizing: border-box;
        }

        .sidebar-wrapper .menu .submenu .submenu-item.active>a {
            color: #ea342a;
            font-weight: 700;
        }

    </style>
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href=""><img src="{{ url('mazer/assets/images/logo/logo.png') }}" alt="Logo"></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">{{ __('admin_application_data.management_data') }}</li>

                        <li class="sidebar-item {{ Route::is('article.*') ? 'active' : '' }}">
                            <a href="{{ route('admin-dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Article</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item {{ Route::is('banner.*') ? 'active' : '' }}">
                            <a href="{{ route('applications.index') }}" class='sidebar-link'>
                                <i class="bi bi-book-half"></i>
                                <span>Banner</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item {{ Route::is('game.*') ? 'active' : '' }}">
                            <a href="{{ route('programs.index') }}" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span>Game</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item {{ Route::is('match.*') ? 'active' : '' }}">
                            <a href="{{ route('universities.index') }}" class='sidebar-link'>
                                <i class="bi bi-building"></i>
                                <span>Match</span>
                            </a>
                        </li>

                        <li
                            class="sidebar-item {{ Route::is('partner.*') ? 'active' : '' }}">
                            <a href="{{ route('users.index') }}" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Partner</span>
                            </a>
                        </li>

                        <li class="sidebar-item  {{ Route::is('squad.*') ? 'active' : '' }}">
                            <a href="{{ route('messages.index') }}" class='sidebar-link'>
                                <i class="bi bi-envelope-fill"></i>
                                <span>Squad</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class='mb-3'>
                <nav class="navbar navbar-expand navbar-light ">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                            </ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600 text-capitalize">
                                                {{ Auth::user()->full_name != null ? Auth::user()->full_name : 'Full Name' }}
                                            </h6>
                                            <p class="mb-0 text-sm text-gray-600">
                                                {{ Auth::user()->role != null ? Auth::user()->role : 'Role' }}
                                            </p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img
                                                    src="{{ Auth::user() != null && Auth::user()->profile_photo_path != null? url(Auth::user()->profile_photo_path): url('mazer/assets/images/faces/1.jpg') }}">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <h6 class="dropdown-header">Hello,
                                            {{ Auth::user()->username != null ? Auth::user()->username : 'username' }}!
                                        </h6>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('admin-profile.index') }}"><i
                                                class="icon-mid bi bi-person me-2"></i>
                                            Profile</a></li>
                                    <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" role="button">
                                            <i class="icon-mid bi bi-box-arrow-left me-2"></i>

                                            {{ __('Sign Out') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>@yield('title_table')</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard /
                                        </a></li>&nbsp;
                                    @yield('breadcumb')
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    @yield('content')
                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Yo Edu</p>
                    </div>
                </div>
            </footer>

        </div>
    </div>
    <script src="{{ url('mazer/assets/vendors/choices.js/choices.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"
        integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="{{ url('mazer/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('mazer/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ url('mazer/assets/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <script src="{{ url('mazer/assets/vendors/toastify/toastify.js') }}"></script>
    <script src="{{ url('mazer/assets/js/extensions/toastify.js') }}"></script>

    <script src="{{ url('mazer/assets/vendors/summernote/summernote-lite.min.js') }}"></script>
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 120,
        })

        $('#summernote1').summernote({
            tabsize: 2,
            height: 120,
        })
    </script>
    @yield('script')
</body>

</html>
