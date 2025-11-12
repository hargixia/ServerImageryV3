<div class="container-fluid py-3">
    <div class="row mt-2">
        <!-- NAVBAR SAMPING -->
        <div class="col-12 col-md-3 col-lg-2 mb-3 mb-md-0">
            <aside class="sticky-top">
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

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
