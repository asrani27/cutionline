
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
    <a href="/pegawai/home" class="nav-link">
        <i class="nav-icon fas fa-home"></i>
        <p>
        Beranda
        </p>
    </a>
    </li>
    <li class="nav-item">
    <a href="/pegawai/profil" class="nav-link">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>
        Profil
        </p>
    </a>
    </li>
    <li class="nav-item">
    <a href="/pegawai/surat-sakit" class="nav-link">
        <i class="nav-icon fas fa-file"></i>
        <p>
        Surat Sakit
        </p>
    </a>
    </li>
    <li class="nav-item">
    <a href="/pegawai/riwayat/cuti" class="nav-link">
        <i class="nav-icon fas fa-file"></i>
        <p>
        Riwayat Cuti
        </p>
    </a>
    </li>
    @if (Auth::user()->pegawai->jabatan != null)        
        @if (Auth::user()->pegawai->jabatan->view == 1)
        
        <li class="nav-item">
        <a href="/pegawai/cuti/semuapegawai" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
            Cuti Semua Pegawai
            </p>
        </a>
        </li> 
        @endif
    @endif
    
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