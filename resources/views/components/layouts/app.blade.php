<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- Load CKEditor -->
        <script src="{{ config('app.url') }}/ckeditor/ckeditor.js"></script>

         <!-- Page Title -->
        <title>{{ $title ?? 'Page Title' }}</title>

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        <style>
        /* 🔹 Hilangkan margin/padding default */
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            overflow-x: hidden;
            background-color: var(--background);
        }

        /* 🔹 Sticky header dengan efek transparan */
        header {
            position: sticky;
            z-index: 1000;
            top: 0;
            background: rgba(58, 176, 255, 0.9); /* Warna primary + transparansi */
            backdrop-filter: blur(6px); /* Efek blur di belakang */
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }

        /* 🔹 Saat discroll, tambahkan sedikit bayangan */
        header.scrolled {
            background: rgba(58, 176, 255, 0.95);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        main {
            width: 100%;
        }
        /* Efek hover border animasi */
        .profile-pic {
            border-color: rgba(255, 255, 255, 0.9);
            transition: border-color 0.4s ease, box-shadow 0.4s ease;
        }

        .profile-pic:hover {
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.6);
        }
        .dropdown-menu .dropdown-item:hover {
            background-color: #6c757d; /* warna hover abu gelap */
            color: white;
        }
        /* Dropdown styling */
        .dropdown-menu-custom {
            position: absolute;
            right: 0;
            top: 55px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 8px;
            min-width: 150px;
            display: none;
            flex-direction: column;
            overflow: hidden;
            z-index: 2000;
        }

        .dropdown-item-custom {
            color: #333;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
            transition: background 0.3s;
        }

        .dropdown-item-custom:hover {
            background: rgba(58, 176, 255, 0.15);
        }
        /* Card hover effect */
        .card-m {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-m:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
        /* Sidebar navigation styling */
        .sidebar-nav .nav-item {
            border-bottom: 1px solid rgba(255, 255, 255, 0.15); /* garis pembatas halus */
        }

        .sidebar-nav .nav-link {
            color: white;
            padding: 10px 16px;
            transition: background-color 0.3s, padding-left 0.2s;
        }

        .sidebar-nav .nav-link:hover {
            background-color: rgba(0, 0, 0, 0.2); /* warna sedikit lebih gelap saat hover */
            padding-left: 20px; /* efek sedikit geser */
        }

        .sidebar-nav .nav-link.active {
            background-color: rgba(0, 0, 0, 0.35); /* warna aktif */
            font-weight: 600;
            border-left: 4px solid var(--color-primary, #0d6efd); /* garis indikator aktif di kiri */
            padding-left: 20px;
        }

        .materi-btn {
            transition: all 0.25s ease;
            border-radius: 12px;
        }
        .materi-btn:hover {
            transform: translateY(-4px);
            background-color: var(--bs-primary);
            color: white;
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        .modal-content {
            border: none;
        }

        /* Responsif untuk tampilan kecil */
        @media (max-width: 768px) {
            .card {
                padding: 1rem !important;
            }

            h2 {
                font-size: 1.4rem;
                text-align: center;
            }

            aside {
                position: static !important;
                margin-bottom: 1rem;
            }

            .form-control {
                font-size: 0.95rem;
            }

        }


    </style>
    </head>
    <body class="m-0 p-0">
    <!-- HEADER -->
    <header class="d-flex justify-content-between align-items-center p-3 text-white shadow-sm sticky-top">
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
            @if (Auth::check() && Auth::user()->nama)
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
            @endif
        </div>
    </header>


    <!-- KONTEN HALAMAN -->
    <main class="w-100">
        {{ $slot }}
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Script untuk deteksi scroll -->
    <script>
        window.addEventListener('scroll', function () {
            const header = document.querySelector('header');
            if (window.scrollY > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
        const profilePic = document.querySelector('.profile-pic');
        const profileMenu = document.getElementById('profileMenu');

        profilePic.addEventListener('click', () => {
            profileMenu.style.display = profileMenu.style.display === 'flex' ? 'none' : 'flex';
        });

        // Tutup dropdown jika klik di luar
        window.addEventListener('click', function(e) {
            if (!profilePic.contains(e.target) && !profileMenu.contains(e.target)) {
                profileMenu.style.display = 'none';
            }
        });
    </script>
</body>
</html>
