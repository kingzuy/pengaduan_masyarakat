<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main" data-color="primary">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0">
            <strong>Pengaduan Masyarakat</strong>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if (auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="{{ url('/admin') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/admin') ? 'active' : '' }}"
                        href="{{ route('admin.admin') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-badge text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Admin</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/petugas') ? 'active' : '' }}"
                        href="{{ route('admin.petugas') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-badge text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Petugas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/masyarakat') ? 'active' : '' }}"
                        href="{{ route('admin.masyarakat') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-users text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Masyarakat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/laporan') ? 'active' : '' }}"
                        href="{{ route('admin.pengaduan') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="far fa-file-alt text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Laporan Masyarakat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/rekap') ? 'active' : '' }}"
                        href="{{ route('admin.laporan') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="far fa-file-pdf text-secondary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Rekap Laporan</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->role == 'petugas')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('petugas') ? 'active' : '' }}" href="{{ url('/petugas') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('petugas/masyarakat') ? 'active' : '' }}"
                        href="{{ url('/petugas/masyarakat') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-users text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Masyarakat</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('petugas/laporan') ? 'active' : '' }}"
                        href="{{ url('/petugas/laporan') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="far fa-file-alt text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Laporan Masyarakat</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>
