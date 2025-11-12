<div class="container-fluid p-0">
    <div class="row g-0">
        <div class="col-2 bg-light border-end vh-100 p-3 position-sticky top-0 d-none d-md-block">
            <aside class="sticky-top">
                @include('components.navbar')
            </aside>
        </div>

        <main class="col-12 col-lg-10 p-4">
            <!-- Informasi Judul, Bidang, Aplikasi -->
            <div class="mb-3">
                <div class="d-flex flex-wrap align-items-start mb-2">
                    <div class="fw-bold me-2" style="min-width:100px;">Judul</div>
                    <div class="me-2">:</div>
                    <div class="flex-grow-1">{{$m_judul}}</div>
                </div>

                <div class="d-flex flex-wrap align-items-start mb-2">
                    <div class="fw-bold me-2" style="min-width:100px;">Bidang</div>
                    <div class="me-2">:</div>
                    <div class="flex-grow-1">{{$m_bidang->bidang}}</div>
                </div>

                <div class="d-flex flex-wrap align-items-start mb-2">
                    <div class="fw-bold me-2" style="min-width:100px;">Aplikasi</div>
                    <div class="me-2">:</div>
                    <div class="flex-grow-1">{{$m_app->nama}}</div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="card mt-2">
                <div class="card-header">
                    <h5>Deskripsi</h5>
                </div>
                <div class="card-body">
                    <p>{{$m_deskripsi}}</p>
                </div>
            </div>

            <!-- Tombol -->
            <div class="row mt-3 mb-3 justify-content-center sticky-top">
                <div class="col-12 col-sm-3 mb-2 mb-sm-0">
                    <button type="button" class="btn btn-danger w-100">Lakukan Test</button>
                </div>
                <div class="col-12 col-sm-3 mb-2 mb-sm-0">
                    <button type="button" class="btn btn-success w-100">Lihat Perkembangan</button>
                </div>

                @if ($user_edit == 1)
                    <div class="col-12 col-sm-3 mb-2 mb-sm-0">
                        <button type="button" class="btn btn-primary w-100" wire:click='tambahKuisoner({{$idm}})'>Edit Test</button>
                    </div>

                    <div class="col-12 col-sm-3">
                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Materi</button>
                    </div>
                @endif
            </div>

            <!-- List Materi -->
            @php
                $i = 1;
                $c = count($m_detail)
            @endphp

            @if ($c > 0)
                <ul class="list-group">
                    @foreach ($m_detail as $md)
                        <li class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title">{{ $md->judul }}</h5>
                                <p class="card-text">{{ $md->deskripsi }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="mt-4">Tidak ada materi untuk ditampilkan ya.</p>
            @endif
        </main>

        <!-- Modal Pilih Tipe Materi -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- ukuran besar dan tengah -->
                <div class="modal-content border-0 shadow-lg rounded-4">

                    <div class="modal-header bg-primary text-white rounded-top-4">
                        <h5 class="modal-title fw-semibold" id="exampleModalLabel">
                            <i class="bi bi-book me-2"></i>Pilih Tipe Materi
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body py-4">
                        <div class="row g-3 justify-content-center">
                            @for ($i = 0; $i < count($tipe_list); $i++)
                                <div class="col-6 col-md-4 col-lg-3">
                                    <button
                                        type="button"
                                        class="btn btn-outline-primary w-100 py-3 fw-semibold materi-btn"
                                        wire:click="tambahMateri({{ $id }}, {{ $i }})"
                                    >
                                        <!-- Pilihan ikon otomatis (contoh umum) -->
                                        @if (str_contains(strtolower($tipe_list[$i]), 'video'))
                                            <i class="bi bi-play-circle fs-3 mb-2 d-block"></i>
                                        @elseif (str_contains(strtolower($tipe_list[$i]), 'teks'))
                                            <i class="bi bi-file-text fs-3 mb-2 d-block"></i>
                                        @elseif (str_contains(strtolower($tipe_list[$i]), 'gambar'))
                                            <i class="bi bi-image fs-3 mb-2 d-block"></i>
                                        @elseif (str_contains(strtolower($tipe_list[$i]), 'kuis'))
                                            <i class="bi bi-question-circle fs-3 mb-2 d-block"></i>
                                        @else
                                            <i class="bi bi-folder fs-3 mb-2 d-block"></i>
                                        @endif
                                        {{ $tipe_list[$i] }}
                                    </button>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
