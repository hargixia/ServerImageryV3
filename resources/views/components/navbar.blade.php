<h1 class="border bg-primary text-white mt-3 rounded-2">IMAGERY WEB</h1>

<ul class="nav flex-column bg-secondary rounded-2" style="height:90vh;">
    <li class="nav-item">
        <a class="nav-link text-white" href="/dashboard">Dashboard</a>
    </li>

    <li class="nav-item">
        <a class="nav-link text-white" href="/materi">Daftar Materi</a>
    </li>

    @if (Auth::user()->id_role == 1)
        <li class="nav-item">
            <a class="nav-link text-white" href="/pengguna">Daftar Pengguna</a>
        </li>
    @endif

    <li class="nav-item">
        <a class="nav-link text-white" href="/akun">Akun Anda</a>
    </li>

    <li class="nav-item">
        <a href="/logout" class="btn btn-danger" style="width:100%;text-align:left;padding-left:16px">Logout</a>
    </li>

</ul>
