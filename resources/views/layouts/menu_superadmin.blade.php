
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
    <a href="/superadmin/home" class="nav-link {{ Request::is('superadmin/home*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>
        Beranda
        </p>
    </a>
    </li>
    <li class="nav-item">
    <a href="/superadmin/profil" class="nav-link {{ Request::is('superadmin/profil*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>
            Profil
        </p>
    </a>
    </li>
    {{-- <li class="nav-item">
    <a href="/superadmin/skpd" class="nav-link {{ Request::is('superadmin/skpd*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-university"></i>
        <p>
        SKPD
        </p>
    </a>
    </li> --}}
    <li class="nav-item">
    <a href="/superadmin/pegawai" class="nav-link {{ Request::is('superadmin/pegawai*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Pegawai
        </p>
    </a>
    </li>
    <li class="nav-item">
    <a href="/superadmin/manajemen/instalasi" class="nav-link {{ Request::is('superadmin/manajemen/instalasi*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Instalasi & Ruangan
        </p>
    </a>
    </li>
    <li class="nav-item">
    <a href="/superadmin/manajemen/jabatan" class="nav-link {{ Request::is('superadmin/manajemen/jabatan*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-sitemap"></i>
        <p>
            Jabatan
        </p>
    </a>
    </li>
    <li class="nav-item">
    <a href="/superadmin/manajemen/struktural" class="nav-link {{ Request::is('superadmin/manajemen/struktural*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-sitemap"></i>
        <p>
            Manajemen 
        </p>
    </a>
    </li>
    <li class="nav-item">
    <a href="/superadmin/datacuti" class="nav-link {{ Request::is('superadmin/datacuti') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file"></i>
        <p>
            Data Cuti 
        </p>
    </a>
    </li>
    <li class="nav-item">
    <a href="/superadmin/ttd" class="nav-link {{ Request::is('superadmin/ttd') ? 'active' : '' }}">
        <i class="nav-icon fas fa-edit"></i>
        <p>
            TTD 
        </p>
    </a>
    </li>
    {{-- <li class="nav-item">
    <a href="/superadmin/setting/kategori/upload" class="nav-link {{ Request::is('superadmin/setting/kategori/upload') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file"></i>
        <p>
        Kategori Upload
        </p>
    </a>
    </li> --}}
    
    <li class="nav-item">
    <a href="/logout" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>
        Logout
        </p>
    </a>
    </li>
</ul>
</nav>