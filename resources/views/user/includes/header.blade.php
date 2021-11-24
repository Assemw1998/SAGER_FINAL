<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin6">
            <a class="navbar-brand" href="dashboard.html">
                <b class="logo-icon">
                    <img src="{{asset("images/public/sager_logo.png")}}" alt="homepage" width="50" />
                </b>
            </a>
            <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <ul class="navbar-nav d-none d-md-block d-lg-none">
                <li class="nav-item">
                    <a class="nav-toggler nav-link waves-effect waves-light text-white"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li>
                    <span class="text-white font-medium mr-2">@php echo auth()->user()->first_name." ".auth()->user()->last_name;@endphp</span>
                </li>

                <li>
                    <a href={{url('/logout')}} class="btn btn-outline-danger text-light">Log Out</a>
                </li>
            </ul>

        </div>
    </nav>
</header>