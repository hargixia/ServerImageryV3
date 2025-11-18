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
        <main class="col-12 col-md-10 px-3 px-md-5 py-4"
              style="background-color: var(--color-bg); min-height: 100vh;">

            <!-- HEADER -->
            <div class="mb-4 text-center text-md-start">
                <h1 class="fw-bold text-primary mb-2">Isi {{$mode }}</h1>
                <p class="text-secondary mb-0">
                    Jawablah setiap pertanyaan dengan jujur dan sesuai pendapat Anda.
                </p>
            </div>

            <!-- TOMBOL KEMBALI -->
            <div class="mb-4 text-center text-md-start">
                <button
                   class="btn btn-outline-secondary px-4 py-2 fw-semibold shadow-sm" wire:click='kembali'>
                    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
                </button>
            </div>

            <!-- FEEDBACK SELESAI -->
            @if ($kirim != null)
                <div class="alert alert-success text-center mt-4 shadow-sm">
                    🎉 Selamat! Kamu telah menyelesaikan kuesioner ini.
                    <p>Nilai Anda adalah {{$nilai}}</p>
                    <p>Dengan Kategori {{$kategori}}</p>
                    <hr>
                    @if ($rekomendasi == "")
                        <p>Anda direkomendasikan : {{$rekomendasi}}</p>
                        <p></p>
                    @endif
                </div>
            @else
                @if (count($kuisoner) <= 0)
                    <div class="alert alert-warning text-center shadow-sm" role="alert">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        Tidak ada kuesioner tersedia untuk materi ini.
                    </div>
                @else
                    @foreach ($kuisoner as $k)
                        <div class="card mb-4 shadow-sm border-0 rounded-4 w-100">
                            <div class="card-body">
                                <h5 class="card-title text-primary mb-3">
                                    <i class="bi bi-question-circle me-2"></i>
                                    Soal Nomor {{ $k->no }}
                                </h5>
                                <p class="card-text fs-5 mb-4">{{ $k->soal }}</p>

                                <div class="row gy-2">
                                    @foreach ($opsi as $i => $o)
                                        <div class="col-12 col-sm-6">
                                            <div class="form-check ps-4">
                                                <input
                                                    class="form-check-input me-2"
                                                    type="radio"
                                                    name="soal_{{ $k->no }}"
                                                    id="soal_{{ $k->no }}_{{ $i }}"
                                                    wire:click="jawab({{ $k->no }}, '{{ $i }}')">
                                                <label class="form-check-label" for="soal_{{ $k->no }}_{{ $i }}">
                                                    {{ $o }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach


                    <!-- TOMBOL KIRIM -->
                    <div class="text-center mt-4">
                        <button type="button"
                        class="btn btn-primary btn-lg px-5 py-2 fw-semibold shadow-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#confirmModal">
                        <i class="bi bi-send-fill me-2"></i> Kirim Jawaban
                    </button>
                </div>
            @endif

                <!-- MODAL KONFIRMASI -->
                <div wire:ignore.self class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold text-primary" id="confirmModalLabel">
                                    Konfirmasi Pengiriman
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <p class="mb-3 fs-5">
                                    Apakah Anda yakin ingin mengirim jawaban Anda sekarang?
                                </p>
                                <small class="text-muted">
                                    Pastikan semua pertanyaan sudah dijawab sebelum mengirim.
                                </small>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                    Batal
                                </button>
                                <button type="button"
                                        class="btn btn-primary px-4"
                                        wire:click="kirimJawaban"
                                        data-bs-dismiss="modal">
                                    <i class="bi bi-check-circle me-1"></i> Ya, Kirim
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            @endif
        </main>
    </div>
</div>
