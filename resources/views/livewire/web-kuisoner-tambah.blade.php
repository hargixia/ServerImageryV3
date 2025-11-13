<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- SIDEBAR -->
        <div class="col-12 col-md-3 col-lg-2 bg-light border-end p-3 d-none d-md-block"
             style="position: sticky; top: 80px; height: calc(100vh - 80px); overflow-y: auto;">
            <aside>
                @include('components.navbar')
            </aside>
        </div>

        <!-- MAIN CONTENT -->
        <main class="col-12 col-md-9 col-lg-10 px-3 px-md-5 py-4" 
              style="background-color: var(--color-bg); min-height: 100vh;">
              
            <div class="mb-4 text-center text-md-start">
                <h1 class="fw-bold text-primary">Tambah Kuisoner</h1>
                <h4 class="text-secondary mt-2">
                    Judul: <span class="fw-semibold">{{ $md->judul }}</span>
                </h4>
            </div>


            <div class="text-center mb-3">
                <h5 class="fw-bold">Daftar Pertanyaan</h5>
            </div>

            <ul class="list-group" wire:poll>
                @php $i = count($pertanyaan); @endphp

                @if ($i <= 0)
                    <p class="text-center text-muted">Tidak ada kuisoner tersedia.</p>
                @else
                    @php $n = 0; @endphp
                    @foreach ($pertanyaan as $p)
                        <li class="card mb-4 border-0 shadow-sm p-2">
                            <div class="card-body">

                                <div class="row g-3">
                                    <!-- Kolom Nomor dan Tipe -->
                                    <div class="col-12 col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Nomor</label>
                                            <input type="number" class="form-control" value="{{ $p->no }}" disabled>
                                        </div>

                                        <div>
                                            <label class="form-label fw-semibold">Tipe Pertanyaan</label>
                                            <div class="ms-2">
                                                
                                                @if ($p->tipe == 'A')
                                                    <span class="badge bg-secondary text-light">Tidak Ada</span>
                                                @elseif ($p->tipe == 'P')
                                                    <span class="badge bg-success text-light">Positif</span>
                                                @elseif ($p->tipe == 'N')
                                                    <span class="badge bg-danger text-light">Negatif</span>
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kolom Isi Soal -->
                                    <div class="col-12 col-md-9">
                                        <label class="form-label fw-semibold">Soal</label>
                                        <div class="border rounded p-2 bg-light">{{ $p->soal }}</div>
                                    </div>
                                </div>

                                <!-- Opsi Jawaban -->
                                <div class="row justify-content-center mt-4 mb-3 text-center">
                                    @foreach ($opsi_jawaban_dipakai as $opsi)
                                        <div class="col-12 col-sm-6 col-md-3 mb-3">
                                            <div class="form-check d-flex justify-content-center">
                                                <input class="form-check-input me-2" type="radio" disabled>
                                                <label class="form-check-label">{{ $opsi }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                                <div class="mt-3">
                                    <p class="mb-1 fw-semibold">Rekomendasi:</p>
                                    <p class="border rounded p-2 bg-light">{{ $reko_d[$n++] }}</p>
                                </div>

                                <button type="button" class="btn btn-danger mt-3" 
                                        wire:click="hapusPertanyaan({{ $p->id }})">
                                    <i class="bi bi-trash me-1"></i> Hapus Pertanyaan
                                </button>
                            </div>
                        </li>
                    @endforeach
                @endif

                <!-- FORM TAMBAH PERTANYAAN -->
                <div class="card mt-2 p-2 shadow-sm border-0">
                    <form wire:submit="tambahPertanyaan">
                        <div class="card-body">
                            <h5 class="fw-bold mb-4 text-primary">Tambah Pertanyaan</h5>

                            <div class="row g-3">
                                <!-- Nomor & Tipe -->
                                <div class="col-12 col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nomor</label>
                                        <input type="number" class="form-control" placeholder="{{ ++$i }}" wire:model="nomor">
                                    </div>

                                    <div>
                                        <label class="form-label fw-semibold">Tipe Pertanyaan</label>
                                        <div class="ms-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model="tipe" value="a" checked>
                                                <label class="form-check-label">Tidak Ada</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model="tipe" value="p">
                                                <label class="form-check-label">Positif</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" wire:model="tipe" value="n">
                                                <label class="form-check-label">Negatif</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Isi Soal -->
                                <div class="col-12 col-md-9">
                                    <label class="form-label fw-semibold">Isi Soal</label>
                                    <textarea class="form-control" rows="6" wire:model="soal" placeholder="Masukkan teks pertanyaan..."></textarea>
                                </div>
                            </div>

                            <!-- Opsi Jawaban -->
                            <div class="row justify-content-center mt-4 mb-3 text-center">
                                    @foreach ($opsi_jawaban_dipakai as $opsi)
                                        <div class="col-12 col-sm-6 col-md-3 mb-3">
                                            <div class="form-check d-flex justify-content-center">
                                                <input class="form-check-input me-2" type="radio" disabled>
                                                <label class="form-check-label">{{ $opsi }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            <!-- Rekomendasi -->
                            <div class="mt-4">
                                <label class="form-label fw-semibold">Rekomendasi</label>
                                <textarea class="form-control" rows="3" wire:model="rekomendasi" placeholder="Masukkan rekomendasi..."></textarea>
                            </div>

                            <!-- Tombol -->
                            <div class="mt-4 d-flex flex-column flex-md-row gap-3">
                                <button type="submit" class="btn btn-primary flex-fill py-2">
                                    <i class="bi bi-plus-circle me-1"></i> Tambah Pertanyaan
                                </button>
                                <button type="button" class="btn btn-outline-danger flex-fill py-2" wire:click="kembali">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </ul>
        </main>
    </div>
</div>
