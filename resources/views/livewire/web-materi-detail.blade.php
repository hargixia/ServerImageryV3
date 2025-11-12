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
                    <div class="flex-grow-1">{{$m_bidang->nama}}</div>
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
                <p class="mt-4">Tidak ada materi untuk ditampilkan.</p>
            @endif
        </main>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pilih Tipe Materi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            @for ($i = 0; $i < count($tipe_list);$i++)
                                <div class="col">
                                    <button type="button" class="btn btn-primary" wire:click='tambahMateri({{$id}},{{$i}})'>{{$tipe_list[$i]}}</button>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
