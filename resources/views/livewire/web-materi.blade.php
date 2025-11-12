<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- SIDEBAR -->
        <aside class="col-2 bg-light border-end vh-100 p-3 position-sticky top-0">
            @include('components.navbar')
        </aside>

        <!-- MAIN CONTENT -->
        <main class="col-10 p-4" style="background-color: var(--color-bg); min-height: 100vh;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="fw-bold text-primary">Daftar Materi</h2>

                @if ($user_edit == 1)
                    <button type="button" class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#modalMateriTambah">
                        + Tambah Materi
                    </button>
                @endif
            </div>
            <!-- PENCARIAN MATERI -->
            <div class="input-group mb-3 shadow-sm" style="max-width: 400px;">
                <span class="input-group-text bg-primary text-white border-0">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text"
                    class="form-control border-0"
                    placeholder="Cari materi..."
                    id="searchMateri"
                    wire:model.defer="searchQuery"
                    wire:keydown.enter="searchMateri"
                    style="background-color: var(--color-light);">
            </div>

            <!-- FILTER BAR -->
            <nav class="navbar navbar-expand-lg rounded shadow-sm mb-3" style="background-color: var(--color-light);">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <button class="btn nav-link text-primary fw-semibold" type="button" wire:click='filterMateri(0)'>
                                    Semua Materi
                                </button>
                            </li>
                            @foreach ($app as $a)
                                <li class="nav-item">
                                    <button class="btn nav-link fw-semibold" type="button" wire:click='filterMateri({{ $a->id }})'>
                                        {{ $a->nama }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </nav>

            <p class='mt-2'>
                Filter: <b class="badge bg-success px-3 py-2">{{ $FilterMateriText }}</b>
            </p>

            <!-- LIST MATERI -->
            @php
                $c = count($data_materi);
            @endphp

            @if ($c > 0)
                <div class="row">
                    @foreach ($data_materi as $dm)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card-m h-100 shadow-sm border-0" style="background-color: var(--color-card); transition: 0.3s;">
                                <div class="card-body d-flex flex-column justify-content-between">

                                    <!-- Bagian gambar dan teks -->
                                    <div>
                                        <!-- Gambar materi -->
                                        <img src="{{ asset('images/materi/' . ($dm->gambar ?? 'default.jpg')) }}"
                                            alt="{{ $dm->judul }}"
                                            class="img-fluid rounded mb-3"
                                            style="height: 150px; width: 100%; object-fit: cover;">

                                        <!-- Judul dan deskripsi -->
                                        <h5 class="card-title text-primary fw-bold">{{ $dm->judul }}</h5>
                                        <p class="card-text text-muted mb-4">{{ $dm->deskripsi }}</p>
                                    </div>

                                    <!-- Tombol -->
                                    <a href="/materi/detail/{{ $dm->id }}" class="btn btn-outline-primary w-100 mt-3">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="mt-4 text-muted">Tidak ada materi untuk ditampilkan.</p>
            @endif
        </main>
    </div>

    <!-- MODAL TAMBAH MATERI -->
    @if ($user_edit == 1)
        <div class="modal fade" id="modalMateriTambah" tabindex="-1" aria-labelledby="modalMateriTambahLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Tambah Materi</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form wire:submit='tambahMateri'>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Judul</label>
                                <input type="text" class="form-control" wire:model='judul'>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Deskripsi</label>
                                <textarea class="form-control" wire:model='deskripsi'></textarea>
                            </div>

                            <label class="form-label fw-semibold">Untuk Aplikasi</label>
                            <div class="row ms-2 mb-3">
                                @foreach ($app as $a)
                                    <div class="form-check col-sm-6">
                                        <input class="form-check-input" type="radio" wire:model='id_app' value="{{ $a->id }}">
                                        <label class="form-check-label">{{ $a->nama }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <label class="form-label fw-semibold">Cabang Olahraga</label>
                            <div class="row ms-2 mb-3">
                                @foreach ($data_bidang as $d)
                                    <div class="form-check col-sm-6">
                                        <input class="form-check-input" type="radio" wire:model='id_bidang' value="{{ $d->id }}">
                                        <label class="form-check-label">{{ $d->nama }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
