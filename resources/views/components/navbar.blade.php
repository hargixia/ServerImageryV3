<ul id="lnav" class="nav flex-column bg-secondary rounded-2 sidebar-nav d-none d-md-flex">
    <li class="nav-item">
        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">Dashboard</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('materi*') ? 'active' : '' }}" href="/materi">Daftar Materi</a>
    </li>

    @if (Auth::user()->id_role == 1)
        <li class="nav-item">
            <a class="nav-link {{ request()->is('pengguna*') ? 'active' : '' }}" href="/pengaturan-akun">Management Pengguna</a>
        </li>
    @endif
</ul>
