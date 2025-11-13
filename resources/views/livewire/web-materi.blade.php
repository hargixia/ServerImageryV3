<div class="container-fluid p-0">
    @if (Auth::check() && Auth::user()->nama)
        @include('components.header')
    @endif
    <div class="row g-0">
        <!-- SIDEBAR -->
        <div class="col-2 bg-light border-end vh-100 p-3 position-sticky top-0 d-none d-md-block">
            <aside class="sticky-top">
                @include('components.navbar')
            </aside>
        </div>

        <!-- MAIN CONTENT -->
        <main class="col-12 col-lg-10 p-4" style="background-color: var(--color-bg); min-height: 100vh;">
            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <h2 class="fw-bold text-primary mb-2">
                    <i class="bi bi-journal-text me-2"></i> Daftar Materi
                </h2>

                @if ($user_edit == 1)
                    <button type="button" class="btn btn-success shadow-sm d-flex align-items-center gap-2"
                        data-bs-toggle="modal" data-bs-target="#modalMateriTambah">
                        <i class="bi bi-plus-lg"></i> Tambah Materi
                    </button>
                @endif
            </div>

            <!-- SEARCH BAR -->
            <div class="search-container mb-4">
                <div class="input-group rounded-pill shadow-sm overflow-hidden" style="max-width: 500px;">
                    <span class="input-group-text bg-white border-0 ps-4">
                        <i class="bi bi-search text-primary"></i>
                    </span>
                    <input type="text"
                        class="form-control border-0 bg-white py-2"
                        placeholder="Cari materi olahraga..."
                        id="searchMateri"
                        wire:model.defer="searchQuery"
                        wire:keydown.enter="searchMateri"
                        style="font-size: 0.95rem;">
                    
                </div>
            </div>

            <!-- PEMISAH -->
            <hr class="border-2 border-primary opacity-25 mb-4" style="border-radius: 5px;">

            <!-- LIST MATERI -->
            @php $c = count($data_materi); @endphp

            @if ($c > 0)
                <div class="row g-4">
                    @foreach ($data_materi as $dm)
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="card-m h-100 shadow-sm border-0 rounded-4"
                                style="background-color: var(--color-card); transition: 0.3s;">
                                <div class="card-body d-flex flex-column justify-content-between">

                                    <!-- Gambar dan teks -->
                                    <div>
                                        <img src="{{ asset('images/materi/' . ($dm->gambar ?? 'default.jpg')) }}"
                                            alt="{{ $dm->judul }}"
                                            class="img-fluid rounded mb-3"
                                            style="height: 160px; width: 100%; object-fit: cover;">

                                        <h5 class="card-title text-primary fw-bold d-flex align-items-center">
                                            <i class="bi bi-book me-2 text-secondary"></i> {{ $dm->judul }}
                                        </h5>
                                        <p class="card-text text-muted small mb-4" style="line-height: 1.4;">
                                            {{ Str::limit($dm->deskripsi, 100) }}
                                        </p>
                                    </div>

                                    <a href="/materi/detail/{{ $dm->id }}"
                                        class="btn btn-outline-primary rounded-pill w-100 mt-auto fw-semibold">
                                        <i class="bi bi-eye me-1"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-muted py-5">
                    <i class="bi bi-emoji-frown fs-1 d-block mb-2"></i>
                    <p class="mb-0">Tidak ada materi untuk ditampilkan.</p>
                </div>
            @endif
        </main>
    </div>

    <!-- MODAL TAMBAH MATERI -->
@if ($user_edit == 1)
    <div class="modal fade" id="modalMateriTambah" tabindex="-1" aria-labelledby="modalMateriTambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-3">
                <div class="modal-header bg-primary text-white align-items-center">
                    <h5 class="modal-title d-flex align-items-center" id="modalMateriTambahLabel">
                        <i class="bi bi-plus-circle me-2 fs-5"></i> Tambah Materi
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form wire:submit.prevent='tambahMateri'>
                    <div class="modal-body p-4">

                        {{-- Judul --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Judul Materi</label>
                            <input type="text" class="form-control" placeholder="Masukkan judul materi..." wire:model='judul'>
                            @error('judul') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan deskripsi materi..." wire:model='deskripsi'></textarea>
                            @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Untuk Aplikasi --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Untuk Aplikasi</label>
                            <div class="row ms-1">
                                @foreach ($app as $a)
                                    <div class="form-check col-sm-6 mb-2">
                                        <input class="form-check-input" type="radio" wire:model='id_app' value="{{ $a->id }}" id="app_{{ $a->id }}">
                                        <label class="form-check-label" for="app_{{ $a->id }}">{{ $a->nama }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('id_app') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Cabang Olahraga --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Cabang Olahraga</label>
                            <div class="row ms-1">
                                @foreach ($data_bidang as $d)
                                    <div class="form-check col-sm-6 mb-2">
                                        <input class="form-check-input" type="radio" wire:model='id_bidang' value="{{ $d->id }}" id="bidang_{{ $d->id }}">
                                        <label class="form-check-label" for="bidang_{{ $d->id }}">{{ $d->bidang }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('id_bidang') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                    </div>

                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i> Tutup
                        </button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save2 me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
</div>
