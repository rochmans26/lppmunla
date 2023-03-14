<aside class="main-sidebar sidebar-dark-white elevation-4" style="background-color: #222E3C">
    <!-- Brand Logo -->
    @if (Auth::user()->level != 'sp-admin')
        <a href="/admin" class="brand-link text-white">
            <img src="{{ asset('img/ikon/Unla.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-bold">LPPM UNLA</span>
        </a>
    @else
        <a href="/sp-admin" class="brand-link text-white">
            <img src="{{ asset('img/ikon/Unla.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-bold">LPPM UNLA</span>
        </a>
    @endif

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center">
            <div class="info">
                @if (Auth::user()->level != 'sp-admin')
                    <a href="/admin" class="d-block">Selamat Datang, {{ Auth::user()->username }}!</a>
                @else
                    <a href="/sp-admin" class="d-block">Selamat Datang, {{ Auth::user()->username }}!</a>
                @endif
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column mb-5" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-header">PROPOSAL</li>
                <li class="nav-item">
                    @if (Auth::user()->level == 'sp-admin')
                        <a href="/sp-admin/proposals"
                            class="nav-link {{ Request::is('sp-admin/proposals') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Pengajuan
                            </p>
                        </a>
                    @else
                        <a href="/admin/proposals"
                            class="nav-link {{ Request::is('admin/proposals') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Pengajuan
                            </p>
                        </a>
                    @endif
                </li>
                <li class="nav-item">
                    @if (Auth::user()->level == 'sp-admin')
                        <a href="/sp-admin/proposals/seminar"
                            class="nav-link {{ Request::is('sp-admin/proposals/seminar') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Seminar Proposal
                            </p>
                        </a>
                    @else
                        <a href="/admin/proposals/seminar"
                            class="nav-link {{ Request::is('admin/proposals/seminar') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Seminar Proposal
                            </p>
                        </a>
                    @endif
                </li>
                <li class="nav-header">HASIL PKM</li>
                <li class="nav-item">
                    @if (Auth::user()->level == 'sp-admin')
                        <a href="/sp-admin/laporan-hasil"
                            class="nav-link {{ Request::is('sp-admin/laporan-hasil') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Laporan Hasil
                            </p>
                        </a>
                    @else
                        <a href="/admin/laporan-hasil"
                            class="nav-link {{ Request::is('admin/laporan-hasil') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Laporan Hasil
                            </p>
                        </a>
                    @endif
                </li>
                <li class="nav-item">
                    @if (Auth::user()->level == 'sp-admin')
                        <a href="/sp-admin/laporan-hasil/seminar"
                            class="nav-link {{ Request::is('sp-admin/laporan-hasil/seminar') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Revisi Hasil
                            </p>
                        </a>
                    @else
                        <a href="/admin/laporan-hasil/seminar"
                            class="nav-link {{ Request::is('admin/laporan-hasil/seminar') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Revisi Hasil
                            </p>
                        </a>
                    @endif
                </li>
                <li class="nav-header">PUBLIKASI</li>
                <li class="nav-item">
                    @if (Auth::user()->level == 'sp-admin')
                        <a href="/sp-admin/publikasi"
                            class="nav-link {{ Request::is('sp-admin/publikasi') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Manajemen Publikasi
                            </p>
                        </a>
                    @else
                        <a href="/admin/publikasi"
                            class="nav-link {{ Request::is('admin/publikasi') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Manajemen Publikasi
                            </p>
                        </a>
                    @endif
                </li>
                <li class="nav-header">Dosen</li>
                <li class="nav-item">
                    @if (Auth::user()->level == 'sp-admin')
                        <a href="/sp-admin/dosens"
                            class="nav-link {{ Request::is('sp-admin/dosens') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Manajemen Dosen
                            </p>
                        </a>
                    @else
                        <a href="/admin/dosens" class="nav-link {{ Request::is('admin/dosens') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Manajemen Dosen
                            </p>
                        </a>
                    @endif
                </li>
                @if (Auth::user()->level == 'sp-admin')
                    <li class="nav-header">User Admin</li>
                    <li class="nav-item">
                        <a href="/sp-admin/users" class="nav-link {{ Request::is('sp-admin/users') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Manajemen User Admin
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-header">Bidang</li>
                <li class="nav-item">
                    @if (Auth::user()->level == 'sp-admin')
                        <a href="/sp-admin/bidangs"
                            class="nav-link {{ Request::is('sp-admin/bidangs') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Manajemen Bidang
                            </p>
                        </a>
                    @else
                        <a href="/admin/bidangs" class="nav-link {{ Request::is('admin/bidangs') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Manajemen Bidang
                            </p>
                        </a>
                    @endif
                </li>
                <li class="nav-header">Jenis Skim</li>
                <li class="nav-item">
                    @if (Auth::user()->level == 'sp-admin')
                        <a href="/sp-admin/skims" class="nav-link {{ Request::is('sp-admin/skims') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Manajemen Skim
                            </p>
                        </a>
                    @else
                        <a href="/admin/skims" class="nav-link {{ Request::is('admin/skims') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Manajemen Skim
                            </p>
                        </a>
                    @endif
                </li>
                <li class="nav-header">Fakultas & Prodi</li>
                <li class="nav-item">
                    @if (Auth::user()->level == 'sp-admin')
                        <a href="/sp-admin/fakultas"
                            class="nav-link {{ Request::is('sp-admin/fakultas') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Manajemen Fakultas
                            </p>
                        </a>
                    @else
                        <a href="/admin/fakultas" class="nav-link {{ Request::is('admin/fakultas') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Manajemen Fakultas
                            </p>
                        </a>
                    @endif
                </li>
                <li class="nav-item">
                    @if (Auth::user()->level == 'sp-admin')
                        <a href="/sp-admin/prodis"
                            class="nav-link {{ Request::is('sp-admin/prodis') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Manajemen Prodi
                            </p>
                        </a>
                    @else
                        <a href="/admin/prodis" class="nav-link {{ Request::is('admin/prodis') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Manajemen Prodi
                            </p>
                        </a>
                    @endif
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
