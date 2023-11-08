<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link {{(Request::segment(1) == 'dashboard') ? 'active' : ''}}" href="{{url ('/dashboard')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <a class="nav-link {{(Request::segment(1) == 'master') ? 'active' : ''}}" href="{{url ('/master')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-database"></i></div>
                Master Data
            </a>
            <a class="nav-link {{(Request::segment(1) == 'stok-masuk') ? 'active' : ''}}" href="{{url ('/stok-masuk')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-box"></i></div>
                Stok Masuk

            <a class="nav-link {{(Request::segment(1) == 'transaksi') ? 'active' : ''}}" href="{{url ('/transaksi')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-tent-arrow-left-right"></i></div>
                Transaksi
            </a>
            <a class="nav-link {{(Request::segment(1) == 'report') ? 'active' : ''}}" href="{{url ('/report')}}">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-database"></i></div>
                Report
            </a>

        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small">Logged in as:</div>
        {{Auth::user()->name}}
    </div>
</nav>
