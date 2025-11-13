<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- SIDEBAR -->
        <div class="col-2 bg-light border-end p-3 d-none d-md-block"
             style="position: sticky; top: 80px; height: calc(100vh - 80px); overflow-y: auto;">
            <aside>
                @include('components.navbar')
            </aside>
        </div>

        <!-- MAIN CONTENT -->
        <main class="col-12 col-lg-10 p-4">
            <!-- Informasi Utama -->
            <div class="mb-3">
                <div class="d-flex flex-wrap align-items-start mb-2">
                    <div class="fw-bold me-2" style="min-width:100px;">Judul</div>
                    <div class="me-2">:</div>
                    <div class="flex-grow-1">{{ $m_judul }}</div>
                </div>

                <div class="d-flex flex-wrap align-items-start mb-2">
                    <div class="fw-bold me-2" style="min-width:100px;">Bidang</div>
                    <div class="me-2">:</div>
                    <div class="flex-grow-1">{{ $m_bidang->bidang }}</div>
                </div>

                <div class="d-flex flex-wrap align-items-start mb-2">
                    <div class="fw-bold me-2" style="min-width:100px;">Aplikasi</div>
                    <div class="me-2">:</div>
                    <div class="flex-grow-1">{{ $m_app->nama }}</div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="card mt-2 shadow-sm border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Deskripsi</h5>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $m_deskripsi }}</p>
                </div>
            </div>

            <!-- Tombol Utama -->
            <div class="row mt-4 mb-4 justify-content-center sticky-top bg-white py-2 shadow-sm rounded">
                <div class="col-12 col-sm-3 mb-2 mb-sm-0">
                    <button type="button" class="btn btn-danger w-100 fw-semibold" wire:click='lakukanTest'>
                        <i class="bi bi-pencil-square me-2"></i> Lakukan Test
                    </button>
                </div>
                <div class="col-12 col-sm-3 mb-2 mb-sm-0">
                    <button type="button" class="btn btn-success w-100 fw-semibold" wire:click='kePerkembangan'>
                        <i class="bi bi-bar-chart-line me-2"></i> Lihat Perkembangan
                    </button>
                </div>

                @if ($user_edit == 1)
                    <div class="col-12 col-sm-3 mb-2 mb-sm-0">
                        <button type="button" class="btn btn-primary w-100 fw-semibold" wire:click='tambahKuisoner({{$idm}})'>
                            <i class="bi bi-pencil-square me-2"></i> Edit Test
                        </button>
                    </div>

                    <div class="col-12 col-sm-3">
                        <button type="button" class="btn btn-primary w-100 fw-semibold" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="bi bi-plus-circle me-2"></i> Tambah Materi
                        </button>
                    </div>
                @endif
            </div>

            <!-- List Materi -->
            @if (count($m_detail) > 0)
                <div class="row">
                @foreach ($m_detail as $md)
                    <div class="col-12 mb-3">
                        <div class="card shadow-sm border-0 rounded-4 h-100">
                            <div class="card-body">
                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-2">
                                    <h5 class="card-title text-primary fw-bold mb-2 mb-md-0">
                                        {{ $md->judul }}
                                    </h5>
                                    <span class="badge bg-info text-dark">
                                        <i class="bi bi-tag me-1"></i> {{ $md->tipe ?? 'Materi Umum' }}
                                    </span>
                                </div>

                                <p class="card-text text-secondary mb-3">{{ $md->deskripsi }}</p>

                                @if ($md->tugas == 1)
                                    <span class="badge bg-warning text-dark me-2">
                                        <i class="bi bi-clipboard-check me-1"></i> Tugas Tersedia
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-clipboard-x me-1"></i> Tidak Ada Tugas
                                    </span>
                                @endif

                                <div class="mt-3 d-flex flex-wrap gap-2">
                                    <button type="button" 
                                            class="btn btn-outline-secondary btn-sm fw-semibold"
                                            wire:click='materiTampil({{ $md->id }})'>
                                        <i class="bi bi-clipboard2-check me-1"></i> Lihat Tugas
                                    </button>

                                    <button type="button" 
                                            class="btn btn-outline-primary btn-sm fw-semibold"
                                            wire:click='materiTampil({{ $md->id }})'>
                                        <i class="bi bi-book-open me-1"></i> Baca
                                    </button>

                                    @if ($user_edit == 1)
                                        <button type="button" 
                                                class="btn btn-outline-danger btn-sm fw-semibold"
                                                wire:click='hapusMD({{ $md->id }})'>
                                            <i class="bi bi-trash3 me-1"></i> Hapus Materi
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @else
                <div class="alert alert-warning mt-4 text-center shadow-sm">
                    <i class="bi bi-exclamation-circle me-2"></i> Tidak ada materi untuk ditampilkan.
                </div>
            @endif
        </main>

        <!-- Modal Pilih Tipe Materi -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header bg-primary text-white rounded-top-4">
                        <h5 class="modal-title fw-semibold" id="exampleModalLabel">
                            <i class="bi bi-book me-2"></i>Pilih Tipe Materi
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body py-4">
                        <div class="row g-3 justify-content-center">
                            @foreach ($tipe_list as $i => $tipe)
                                <div class="col-6 col-md-4 col-lg-3">
                                    <button
                                        type="button"
                                        class="btn btn-outline-primary w-100 py-3 fw-semibold materi-btn"
                                        wire:click="tambahMateri({{ $id }}, {{ $i }})"
                                    >
                                        @if (str_contains(strtolower($tipe), 'video'))
                                            <i class="bi bi-play-circle fs-3 mb-2 d-block"></i>
                                        @elseif (str_contains(strtolower($tipe), 'teks'))
                                            <i class="bi bi-file-text fs-3 mb-2 d-block"></i>
                                        @elseif (str_contains(strtolower($tipe), 'gambar'))
                                            <i class="bi bi-image fs-3 mb-2 d-block"></i>
                                        @elseif (str_contains(strtolower($tipe), 'kuis'))
                                            <i class="bi bi-question-circle fs-3 mb-2 d-block"></i>
                                        @else
                                            <i class="bi bi-folder fs-3 mb-2 d-block"></i>
                                        @endif
                                        {{ $tipe }}
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
