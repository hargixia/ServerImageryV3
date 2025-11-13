    <!-- HEADER -->
    <header class="d-flex justify-content-between align-items-center p-3 text-white shadow-sm">
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/logo.png') }}"
                alt="Logo"
                class="me-2"
                style="height:45px; width:auto;">
        </div>

        <div class="d-flex align-items-center">

            
            <!-- Tombol menu untuk layar kecil -->
                <div class="dropdown d-md-none">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="menuDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-list"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="menuDropdown">
                        <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                        <li><a class="dropdown-item" href="/materi">Daftar Materi</a></li>
                        @if (Auth::check() && Auth::user()->id_role == 1)
                            <li><a class="dropdown-item" href="/pengguna">Daftar Pengguna</a></li>
                        @endif
                    </ul>
                </div>
                <span class="me-3 fw-bold text-capitalize d-none d-md-inline" style="font-size:1.1rem;">
                    Hallo {{ Auth::user()->nama }}!
                </span>
                <!-- PROFIL DROPDOWN -->
                <div class="position-relative d-none d-md-inline">
                    <div class="profile-pic rounded-circle overflow-hidden border border-3 border-light" style="width:45px; height:45px; cursor:pointer;">
                        <img src="{{ asset('images/profile.png') }}" alt="Profile" class="w-100 h-100" style="object-fit: cover;">
                    </div>

                    <!-- Dropdown menu -->
                    <div class="dropdown-menu-custom shadow-sm" id="profileMenu">
                        <a href="/akun" class="dropdown-item-custom">My Profile</a>
                        <a href="/logout" class="dropdown-item-custom text-danger">Logout</a>
                    </div>
                </div>
           
        </div>
    </header>
