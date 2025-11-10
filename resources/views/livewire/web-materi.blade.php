<div class="container-fluid">

    <div class="row mt-2">
        <div class="col-2">
            <aside class="sticky-top">
                @include('components.navbar')
            </aside>
        </div>

        <main class="col-10">
            <h1 class="mt-3">Daftar Materi</h1>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <button class="btn nav-link" type="button" wire:click='filterMateri(0)'>Semua Materi</button>
                            </li>
                            @foreach ($app as $a)
                                <li class="nav-item">
                                    <button class="btn nav-link form-control" type="button" wire:click='filterMateri({{$a->id}})'>{{$a->nama}}</button>
                                </li>
                            @endforeach
                        </ul>

                        @if ($user_edit == 1)
                            <div class="d-flex">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalMateriTambah">Tambah Materi</button>
                            </div>

                            <div class="modal fade" id="modalMateriTambah" tabindex="-1" aria-labelledby="modalMateriTambah" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Materi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <Form wire:submit='tambahMateri'>
                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Judul</label>
                                                    <input type="text" class="form-control" wire:model='judul'>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Deskripsi</label>
                                                    <textarea type="text" class="form-control" wire:model='deskripsi'></textarea>
                                                </div>

                                                <label class="form-label mb-3">
                                                        Untuk Aplikasi
                                                </label>

                                                <div class="row ms-2 mb-3">

                                                    @foreach ($app as $a)
                                                        <div class="form-check col-sm-6">
                                                            <input class="form-check-input" type="radio" id="flexRadioDefault1" wire:model='id_app' value="{{ $a->id }}">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                {{ $a->nama }}
                                                            </label>
                                                        </div>

                                                    @endforeach

                                                </div>

                                                <label class="form-label mb-3">
                                                        Cabang Olahraga
                                                </label>

                                                <div class="row ms-2 mb-3">

                                                    @foreach ($data_bidang as $d)
                                                        <div class="form-check col-sm-6">
                                                            <input class="form-check-input" type="radio" id="flexRadioDefault1" wire:model='id_bidang' value="{{ $d->id }}">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                {{ $d->nama }}
                                                            </label>
                                                        </div>

                                                    @endforeach

                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </Form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </nav>

            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                    </ul>
                </div>
            </nav>

            <p class='mt-2'>Filter : <b class="badge bg-success">{{$FilterMateriText}}</b></p>

            @php
                $i = 1;
                $c = count($data_materi)
            @endphp

            @if ($c > 0)
                <ul class="list-group">
                    @foreach ($data_materi as $dm)
                        <li class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title">{{ $dm->judul }}</h5>
                                <p class="card-text">{{ $dm->deskripsi }}</p>
                                <a href="/materi/detail/{{ $dm->id }}" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="mt-4">Tidak ada materi untuk ditampilkan.</p>
            @endif
        </main>

    </div>
</div>
