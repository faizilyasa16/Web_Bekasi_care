<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/Bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/Bootstrap-icon/font/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminstyle.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <title>Admin Panel</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <div class="" id="sidebar-wrapper" style="background-color: #0048E8;">
                    <div class="sidebar-heading text-center py-4 text-light fs-4 fw-bold text-uppercase shadow-lg d-flex align-items-center justify-content-center">
                        <p class="fw-bold mb-0 py-1 poppins" style="font-size: 1em; color: var(--main-text-color);">Admin Panel</p>
                    </div>
                    <div class="list-group list-group-flush poppins-light my-3">
                        <a href="{{ route('dashboard') }}" 
                            class="list-group-item list-group-item-action bg-transparent fw-light d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                            style="font-size: 0.9em;">
                            <i class="bi bi-bar-chart-line fs-4 me-2"></i>Dashboard
                        </a>
                        <a href="{{ route('users') }}" 
                            class="list-group-item list-group-item-action bg-transparent fw-light d-flex align-items-center {{ request()->routeIs('users') ? 'active' : '' }}"
                            style="font-size: 0.9em;">
                            <i class="bi bi-people-fill fs-4 fw-bold me-2"></i>Users
                        </a>
                        <a href="{{ route('berita') }}"
                            class="list-group-item list-group-item-action bg-transparent fw-light d-flex align-items-center {{ request()->routeIs('berita') ? 'active' : '' }}"
                            style="font-size: 0.9em;">
                            <i class="bi bi-newspaper fs-4 me-2"></i>Berita
                        </a>
                        <a href="{{ route('forum') }}" 
                            class="list-group-item list-group-item-action bg-transparent fw-light d-flex align-items-center {{ request()->routeIs('forum') ? 'active' : '' }}"
                            style="font-size: 0.9em;">
                            <i class="bi-chat-left-dots-fill fs-4 fw-bold me-2"></i>Forum
                        </a>
                    <a href="{{ route('laporan') }}" 
                        class="list-group-item list-group-item-action bg-transparent fw-light d-flex align-items-center {{ request()->routeIs('laporan') ? 'active' : '' }}"
                        style="font-size: 0.9em;">
                        <i class="bi bi-file-text-fill fs-4 fw-bold me-2"></i>Laporan
                    </a>
                </div>
            </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light p-0 shadow-sm kantumury" style="background-color: var(--main-bg-color);">
                <div class="d-flex align-items-center ">
                    <div class="px-4 py-4 d-flex justify-content-center" style="background-color: #FFD700;">
                        <i class="bi bi-list-ul text-dark p-0 fs-2" id="menu-toggle"></i>
                    </div>
                    
                    <div class="ms-3 d-flex align-items-center">
                        <img src="{{ asset('img/logo.png') }}" class="me-2" alt="" style="width: 50px; height: 50px;">
                        <p class="fw-bold mb-0 " style="font-size: 1.4em;  color: var(--second-text-color);">Bekasi Care</p>
                    </div>
                </div>
                

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle me-3 fw-bold d-flex align-items-center" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-family: noodle; color: var(--second-text-color); font-size: 0.9em;">
                                <i class="bi bi-person-circle me-2 fs-2"></i>
                                <span class="kantumury">{{ Auth::user()->name }}</span>
                            </a>
                        
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item kantumury">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid p-0" >
                @yield('content')
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>
    @yield('script')
    <script src="{{ asset('css/Bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>