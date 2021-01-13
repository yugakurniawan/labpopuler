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

<div class="app-header__content">

    <div class="app-header-left">
        @yield('search')
    </div>

    <div class="app-header-right">
        @can('dokter-marketing-manager_marketing')
            @php
                switch (auth()->user()->peran->nama) {
                    case 'Dokter':
                        $notifikasi = App\JadwalKunjungan::where('dokter_id', auth()->user()->dokter->kode)->where('dilihat_dokter', 0)->latest()->get();
                        break;

                    case 'Marketing':
                        $notifikasi = App\JadwalKunjungan::where('user_id', auth()->user()->id)->where('status','!=',0)->where('dilihat_marketing', 0)->latest()->get();
                        break;

                    default:
                        $notifikasi = App\JadwalKunjungan::where('dilihat_manager_marketing', 0)->latest()->get();
                        break;
                }
            @endphp
            <div class="header-dots pr-3">
                <div class="dropdown">
                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mr-2 border-0 btn btn-transition btn-outline-light rounded-circle">
                        <i class="fas fa-bell text-warning" style="font-size: 20pt"></i>
                        @if (count($notifikasi) > 0)
                            <span style="position: absolute; font-size: 8pt" class="badge badge-danger rounded-circle">{{ count($notifikasi) }}</span>
                        @endif
                    </button>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right" style="">
                        <div class="text-center">
                            <h5 class="font-weight-bold">Nofitikasi</h5>
                            @if (count($notifikasi) > 0)
                                <p>Anda memiliki {{ count($notifikasi) }} notifikasi</p>
                            @else
                                <p>Anda belum memiliki notifikasi</p>
                            @endif
                        </div>
                        <div tabindex="-1" class="dropdown-divider"></div>
                        @foreach ($notifikasi as $item)
                            @can('dokter')
                                <a href="{{ route('jadwal-kunjungan.show', $item) }}" class="dropdown-item" style="white-space: normal; display: block">
                                    <p>
                                        Pengajuan kunjungan marketing
                                        atas nama <b>{{ $item->user->nama }}</b>
                                    </p>
                                    <div class="text-right text-muted">
                                        <i class="fas fa-clock"></i> {{ date('d F Y - H:i',strtotime($item->jadwal)) }}
                                        @php
                                            switch ($item->status) {
                                                case 1:
                                                    echo "Disetujui";
                                                    break;
                                                case 2:
                                                    echo "Tidak Disetujui";
                                                    break;
                                                default:
                                                    echo "Belum disetujui";
                                                    break;
                                            }
                                        @endphp
                                    </div>
                                </a>
                            @endcan

                            @can('marketing')
                                <a href="{{ route('jadwal-kunjungan.edit', $item) }}" class="dropdown-item" style="white-space: normal; display: block">
                                    <p>
                                        Pengajuan kunjungan marketing
                                        ke dokter <b>{{ $item->dokter->nama }}</b>
                                    </p>
                                    <div class="text-right text-muted">
                                        <i class="fas fa-clock"></i> {{ date('d F Y - H:i',strtotime($item->jadwal)) }}
                                        @php
                                            switch ($item->status) {
                                                case 1:
                                                    echo "Disetujui";
                                                    break;
                                                case 2:
                                                    echo "Tidak Disetujui";
                                                    break;
                                                default:
                                                    echo "Belum disetujui";
                                                    break;
                                            }
                                        @endphp
                                    </div>
                                </a>
                            @endcan

                            @can('manager_marketing')
                                <a href="{{ route('jadwal-kunjungan.show', $item) }}" class="dropdown-item" style="white-space: normal; display: block">
                                    <p>
                                        Pengajuan kunjungan marketing atas nama <b>{{ $item->user->nama }}</b> ke dokter <b>{{ $item->user->nama }}</b>
                                    </p>
                                    <div class="text-right text-muted">
                                        <i class="fas fa-clock"></i> {{ date('d F Y - H:i',strtotime($item->jadwal)) }}
                                        @php
                                            switch ($item->status) {
                                                case 1:
                                                    echo "Disetujui";
                                                    break;
                                                case 2:
                                                    echo "Tidak Disetujui";
                                                    break;
                                                default:
                                                    echo "Belum disetujui";
                                                    break;
                                            }
                                        @endphp
                                    </div>
                                </a>
                            @endcan
                            <div tabindex="-1" class="dropdown-divider"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endcan
        <div class="header-btn-lg pr-0">
            <div class="widget-content p-0">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                        <div class="btn-group">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                class="p-0 btn">
                                <img width="42" class="rounded-circle" src="{{ asset(Storage::url(auth()->user()->avatar)) }}" alt="">
                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                            </a>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                <a href="/profil"  class="dropdown-item">Profil</a>
                                <a href="/ganti-password"  class="dropdown-item">Ganti Password</a>
                                <div tabindex="-1" class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content-left  ml-3 header-user-info">
                        <div class="widget-heading">
                            {{ auth()->user()->nama }}
                        </div>
                        <div class="widget-subheading">
                            {{ auth()->user()->peran->nama }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
