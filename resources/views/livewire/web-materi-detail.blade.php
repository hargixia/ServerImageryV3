<div class="container-fluid">

    <div class="row mt-2">
        <div class="col-2">
            <aside class="sticky-top">
                @include('components.navbar')
            </aside>
        </div>

        <main class="col-10">

            <div class="row mt-3 mb-3">
                <div class="col-sm-1">
                    <h1>Judul</h1>
                </div>
                <div class="col-sm-9">
                    <h1>: {{$m_judul}}</h1>
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-sm-1">
                    <h4>Bidang</h4>
                </div>
                <div class="col-sm-9">
                    <h4>: {{$m_bidang->nama}}</h4>
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-sm-1">
                    <h4>Aplikasi</h4>
                </div>
                <div class="col-sm-9">
                    <h4>: {{$m_app->nama}}</h4>
                </div>
            </div>

            <div class='card mt-2'>
                <div class="card-header">
                    <h5>Deskripsi</h5>
                </div>
                <div class="card-body">
                    <p>{{$m_deskripsi}}</p>
                </div>
            </div>

            <div class="row mt-3 mb-3 justify-content-center sticky-top">
                <div class="col-sm-3">
                    <button type="button" class="btn btn-danger" style="width: 100%">Lakukan Test</button>
                </div>
                <div class="col-sm-3">
                    <button type="button" class="btn btn-success" style="width: 100%">Lihat Perkembangan</button>
                </div>
                @if ($user_edit == 1)
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-primary" style="width: 100%" wire:click='tambahKuisoner({{$idm}})'>Edit Test</button>
                    </div>

                    <div class="col-sm-3">
                        <button type="button" class="btn btn-primary" style="width: 100%" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Materi</button>
                    </div>
                @endif
            </div>

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
