<div>

    <div class="row mt-2">
        <div class="col-2">
            <aside class="sticky-top">
                @include('components.navbar')
            </aside>
        </div>

        <!-- KONTEN UTAMA -->
        <main class="col-12 col-md-9 col-lg-10">
            <div class="card shadow-sm border-0 p-4" style="background-color: var(--color-card);">
                <h2 class="fw-bold text-primary mb-4 text-center text-md-start">Tambah Materi</h2>

                <form wire:submit.prevent='tambahMateri'>
                        <label class="form-label fw-semibold">Judul</label>
                        <input type="text" class="form-control" wire:model='detail_judul' placeholder="Masukkan judul materi...">
                        <label class="form-label fw-semibold">
                            Tipe Materi : <span class="badge bg-info text-dark">{{ $tipe_pilih }}</span>
                        </label>
                    <div class="mb-4" wire:ignore>
                        <label class="form-label fw-semibold">Isi</label>
        <main class="col-10">
            <h1 class="mt-3">Tambah Materi</h1>

            <form wire:submit='tambahMateri'>
                <div class="modal-body">

                    <div class="mb-3">
                        <label  class="form-label">Judul</label>
                        <input type="text" class="form-control" wire:model='detail_judul'>
                    </div>

                    <div class="mb-3">
                        <label  class="form-label">Deskripsi</label>
                        <textarea type="text" class="form-control" wire:model='detail_deskripsi'></textarea>
                    </div>

                    <label class="form-label mb-3">
                        Tipe Materi : {{ $tipe_pilih }}
                    </label>

                    <div class="mb-3" wire:ignore>
                        <label  class="form-label">Isi</label>
                        @if ($tipe_pilih == 'teks')
                            <textarea name="editor1" id="editor1" rows="10" class="form-control" wire:model='detail_isi'></textarea>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    const editor = CKEDITOR.replace('editor1');
                                    editor.on('change', function() {
                                        @this.set('detail_isi', editor.getData());
                                    });

                                    var editor = CKEDITOR.replace( 'editor1' );
                                    editor.on( 'change', function( evt ) {
                                        @this.set('detail_isi',editor.getData());
                                    });

                                });
                            </script>
                        @else
                            <input type="file" class="form-control mt-2" wire:model='detail_file'>
                        @endif
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4">
                            Simpan
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click='kembali' data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </main>
    </div>

</div>
