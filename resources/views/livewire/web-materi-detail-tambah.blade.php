<div>

    <div class="row mt-2">
        <div class="col-2">
            <aside class="sticky-top">
                @include('components.navbar')
            </aside>
        </div>

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

                                    var editor = CKEDITOR.replace( 'editor1' );
                                    editor.on( 'change', function( evt ) {
                                        @this.set('detail_isi',editor.getData());
                                    });

                                });
                            </script>
                        @else
                            <input type="file" class="form-control mt-2" wire:model='detail_file'>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </main>
    </div>

</div>
