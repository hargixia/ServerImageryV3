<div class="container-fluid p-0">
    <div class="row g-0">

        <!-- SIDEBAR -->
        <div class="col-2 bg-light border-end p-3 d-none d-md-block"
             style="position: sticky; top: 80px; height: calc(100vh - 80px); overflow-y:auto;">
            <aside>
                @include('components.navbar')
            </aside>
        </div>

        <!-- MAIN CONTENT -->
        <main class="col-12 col-md-10 p-4">


            <!-- HEADER -->
            <div class="mb-4">
                <h2 class="fw-bold text-primary">Tugas</h2>
                <p class="text-secondary">Silakan kerjakan tugas berikut dengan baik.</p>
            </div>

            <!-- TOMBOL KEMBALI -->
            <div class="mb-4 text-center text-md-start">
                <button
                    class="btn btn-outline-secondary px-4 py-2 fw-semibold shadow-sm" wire:click='kembali'>
                    <i class="bi bi-arrow-left-circle me-2"></i> Kembali
                </button>
            </div>

            @if ($kirim == 4)
                <div class="card mb-3">
                    <div class="card-body">
                        <p>Nama : {{$dtugas->nama}}</p>
                    </div>
                </div>
            @endif

            <!-- CARD SOAL -->
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h5 class="mb-0">Isi Soal</h5>
                </div>
                <div class="card-body">
                    <p class="mb-0 fs-5">
                        {{ $tugas[0][0] }}
                    </p>
                </div>
            </div>

            <!-- CARD KIRIM TUGAS -->
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-success text-white rounded-top-4">
                    <h5 class="mb-0">Kirim Jawaban Anda</h5>
                </div>

                <div class="card-body">
                    <form wire:submit.prevent="kirimTugas">
                        <label class="fw-semibold mb-2">Isi Jawaban:</label>

                        <textarea class="form-control mb-3" rows="6" wire:model="t_isi"
                            placeholder="Tulis jawaban Anda di sini..." @if ($kirim == 3)
                                disabled
                            @endif></textarea>
                        {{ $kirim }}
                        @if($kirim == 0)
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    Kirim Tugas
                                </button>
                            </div>
                        @endif
                    </form>

                    {{ $ss }}
                    <p>
                        exp {{ $materi_detail->stop }}
                    </p>
                    @if ($kirim == 4)
                        <div class="row">
                            <div class="col">

                            </div>
                            <div class="col">
                                <div class="text-end">
                                    <button class="btn btn-primary px-4">
                                        Beri Nilai Tugas
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </main>
    </div>
</div>
