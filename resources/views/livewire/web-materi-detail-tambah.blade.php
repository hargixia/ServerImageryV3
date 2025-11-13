<div class="container-fluid py-0">
    <div class="row mt-2">
        <!-- NAVBAR SAMPING -->
        <div class="col-2 bg-light border-end p-3 d-none d-md-block"
             style="position: sticky; top: 80px; height: calc(100vh - 80px); overflow-y: auto;">
            <aside>
                @include('components.navbar')
            </aside>
        </div>


        <!-- KONTEN UTAMA -->
        <main class="col-12 col-md-9 col-lg-10">
            <div class="card shadow-sm border-0 p-4" style="background-color: var(--color-card);">
                <h2 class="fw-bold text-primary mb-4 text-center text-md-start">Tambah Materi</h2>

                <form wire:submit.prevent='tambahMateri'>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul</label>
                        <input type="text" class="form-control" wire:model='detail_judul' placeholder="Masukkan judul materi...">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control" rows="3" wire:model='detail_deskripsi' placeholder="Deskripsi singkat materi..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Tipe Materi : <span class="badge bg-info text-dark">{{ $tipe_pilih }}</span>
                        </label>
                    </div>

                    <div class="mb-4" wire:ignore>
                        @if ($tipe_pilih == 'teks')
                            <textarea name="editor1" id="editor1" rows="10" class="form-control" wire:model='detail_isi'></textarea>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    const editor = CKEDITOR.replace('editor1');
                                    editor.on('change', function() {
                                        @this.set('detail_isi', editor.getData());
                                    });
                                });
                            </script>
                        @else
                            <input type="file" class="form-control mt-2" wire:model='detail_file'>
                        @endif
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" {{ $tugasStat }} value="" id="flexCheckDefault" wire:click='onTugas()'>
                        <label class="form-check-label" for="flexCheckDefault" wire:click='onTugas()'>
                            Kasih Tugas
                        </label>
                    </div>

                    @if ($tugasStat == "Checked")
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>

                                <textarea name="editor2" id="editor2" rows="10" class="form-control" wire:model='isi_tugas'></textarea>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        const editor2 = CKEDITOR.replace('editor2');
                                        editor2.on('change', function() {
                                            @this.set('isi_tugas', editor2.getData());
                                        });
                                    });
                                </script>

                                <div class="mb-3 row mt-3">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Waktu Mulai</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control mb-2" wire:model='tugas_start_date'>
                                        <input type="time" class="form-control" wire:model='tugas_start_time'>
                                    </div>
                                </div>
                                <div class="mb-3 row mt-3">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Waktu Tutup</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control mb-2" wire:model='tugas_stop_date'>
                                        <input type="time" class="form-control" wire:model='tugas_stop_date'>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif

                    <div class="d-flex justify-content-end">

                        <button type="button" class="btn btn-danger px-4 me-3" wire:click='kembali'>
                            Batalkan
                        </button>

                        <button type="submit" class="btn btn-primary px-4">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
