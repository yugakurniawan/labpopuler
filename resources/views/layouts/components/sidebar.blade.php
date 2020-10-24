<div class="app-header__logo">
    <div class="logo-src"></div>
    <div class="header__pane ml-auto">
        <div>
            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                data-class="closed-sidebar">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
</div>

<div class="app-header__mobile-menu">
    <div>
        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
    </div>
</div>

<div class="app-header__menu">
    <span>
        <button type="button"
            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
            <span class="btn-icon-wrapper">
                <i class="fa fa-ellipsis-v fa-w-6"></i>
            </span>
        </button>
    </span>
</div>

<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Dashboards</li>
            <li>
                <a href="{{ url('/') }}" class="{{ Request::segment(1) == '' ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    Dashboard
                </a>
            </li>
            @can('super_admin')
                <li class="app-sidebar__heading">Manajemen Pengguna</li>
                <li>
                    <a href="{{ route('user.index') }}" class="{{ Request::segment(1) == 'user' ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Pengguna
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.create')}}" class="{{ Request::segment(1) == 'tambah-pengguna' ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-add-user"></i>
                        Tambah Pengguna
                    </a>
                </li>
            @endcan
            @can('pengurus_lab')
                <li class="app-sidebar__heading">Manajemen Pasien</li>
                <li>
                    <a href="{{ route('pasien.index')}}" class="{{ Request::segment(1) == 'pasien' ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Pasien
                    </a>
                </li>
                <li>
                    <a href="{{ route('pasien.create') }}" class="{{ Request::segment(1) == 'tambah-pasien' ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-add-user"></i>
                        Tambah Pasien
                    </a>
                </li>
            @endcan
            @can('dokter')
                <li class="app-sidebar__heading">Pasien Saya</li>
                <li>
                    <a href="{{ route('pasien.dokter')}}" class="{{ Request::segment(1) == 'pasien-saya' ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Pasien Saya
                    </a>
                </li>
                <li class="app-sidebar__heading">Jadwal Kunjungan Marketing</li>
                <li>
                    <a href="{{ route('jadwal-kunjungan.index')}}" class="{{ Request::segment(1) == 'jadwal-kunjungan-saya' ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-date"></i>
                        Jadwal Kunjungan Marketing
                    </a>
                </li>
            @endcan
            @can('marketing')
                <li class="app-sidebar__heading">Jadwal Kunjungan Marketing</li>
                <li>
                    <a href="{{ route('jadwal-kunjungan.index')}}" class="{{ Request::segment(1) == 'jadwal-kunjungan-saya' ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-date"></i>
                        Jadwal Kunjungan Marketing
                    </a>
                </li>
                <li>
                    <a href="{{ route('jadwal-kunjungan.create') }}" class="{{ Request::segment(1) == 'tambah-jadwal-kunjungan' ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-date"></i>
                        Tambah Jadwal Kunjungan Marketing
                    </a>
                </li>
            @endcan
            @can('manager_marketing')
                <li class="app-sidebar__heading">Jadwal Kunjungan Marketing</li>
                <li>
                    <a href="{{ route('jadwal-kunjungan.index')}}" class="{{ Request::segment(1) == 'jadwal-kunjungan-saya' ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-date"></i>
                        Jadwal Kunjungan Marketing
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</div>
