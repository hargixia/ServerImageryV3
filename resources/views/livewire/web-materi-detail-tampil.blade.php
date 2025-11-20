<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- SIDEBAR -->
        <div class="col-2 bg-light border-end p-3 d-none d-md-block"
             style="position: sticky; top: 80px; height: calc(100vh - 80px); overflow-y: auto;">
            <aside>
                @include('components.navbar')
            </aside>
        </div>


        <!-- KONTEN UTAMA -->
        <main class="col-12 col-lg-10 p-4" >
            <div class="container py-4">

                <!-- Judul & Deskripsi -->
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-primary text-capitalize">{{ $materiNow->judul }}</h2>
                    <p class="text-muted">{{ $materiNow->deskripsi }}</p>
                    <span class="badge bg-info text-dark text-uppercase px-3 py-2">
                        {{ $materiNow->tipe }}
                    </span>
                </div>
                <!-- PEMISAH -->
                <hr class="border-2 border-primary opacity-25 mb-4" style="border-radius: 5px;">

                <!-- Konten Materi -->
                <div class="mt-1">
                    @if ($materiNow->tipe == 'teks')
                        <div class="card border-0 shadow-sm p-4 bg-light">
                            {!! $materiNow->isi !!}
                        </div>

                    @elseif ($materiNow->tipe == 'video')
                        <div class="ratio ratio-16x9 shadow-sm rounded overflow-hidden">
                            <video controls>
                                <source src="{{$materiNow->isi }}" type="video/mp4">
                                Browser Anda tidak mendukung video tag.
                            </video>
                        </div>

                    @elseif ($materiNow->tipe == 'gambar')
                        <div class="text-center mt-3">
                            <img src="{{ $materiNow->isi }}"
                                 alt="{{ $materiNow->judul }}"
                                 class="img-fluid rounded shadow-sm"
                                 style="max-height: 500px; object-fit: contain;">
                        </div>

                    @elseif ($materiNow->tipe == 'audio')
                        <div class="card border-0 shadow-sm p-4 bg-light text-center">
                            <audio controls class="w-100">
                                <source src="{{ $materiNow->isi }}" type="audio/mpeg">
                                Browser Anda tidak mendukung audio tag.
                            </audio>
                        </div>

                    @else
                        <div class="alert alert-warning text-center">
                            Tidak ada isi materi untuk ditampilkan.
                        </div>
                    @endif
                </div>

                <!-- Tombol Kembali -->
                <div class="text-center mt-5">
                    <button type="button"
                            wire:click="kembali"
                            class="btn btn-secondary px-4 py-2 shadow-sm">
                        <i class="bi bi-arrow-left me-2"></i> Kembali
                    </button>
                </div>

            </div>
        </main>
    </div>
</div>
