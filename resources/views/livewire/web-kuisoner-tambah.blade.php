<div class="container-fluid">

    <div class="row mt-2">
        <div class="col-2">
            <aside class="sticky-top">
                @include('components.navbar')
            </aside>
        </div>

        <main class="col-10">
            <h1 class="mt-3">Tambah Kuisoner</h1>
            <h3 class="mt-2">Judul : {{$md->judul}}</h3>

            <div class="d-flex justify-content-center">
                <h5>Pertanyaan</h5>
            </div>

            <ul class="list-group" wire:poll>
                @php
                    $i = count($pertanyaan);
                @endphp

                @if ($i<=0)
                    <p>Tidak ada kuisoner tersedia</p>
                @else
                    @php
                        $n = 0;
                    @endphp
                    @foreach ($pertanyaan as $p)
                        <li class="card mb-3">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="col">
                                            <div class="row">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">Nomor</span>
                                                    <input type="number" class="form-control" aria-describedby="basic-addon1" value="{{ $p->no }}" disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="exampleFormControlInput1" class="form-label">Tipe Pertanyaan</label>

                                                <div class="ms-3">
                                                    @if ($p->tipe == 'A')
                                                        Tidak Ada
                                                    @elseif ($p->tipe == 'P')
                                                        Positif
                                                    @elseif ($p->tipe == 'N')
                                                        Negatif
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <div class="input-group">
                                            <div class="col">
                                                <div class="row">
                                                    <span class="input-group-text">Isi Soal</span>
                                                </div>
                                                <div class="row">
                                                    <p>{{$p->soal}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center mt-5 mb-2">
                                    @foreach ($opsi_jawaban_dipakai as $opsi)
                                        <div class="col-sm-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    {{ $opsi }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <p>Rekomendasi:</p>
                                <p>{{$reko_d[$n++]}}</p>

                                <button type="button" class="btn btn-danger" wire:click='hapusPertanyaan({{ $p->id }})'>Hapus</button>
                            </div>
                        </li>
                    @endforeach
                @endif
                <div class="card mt-5 mb-5">
                    <form wire:submit='tambahPertanyaan'>
                        <div class="card-body">
                            <h5 class="card-title mb-4">Tambah Pertanyaan</h5>

                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="col">

                                        <div class="row">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Nomor</span>
                                                <input type="number" class="form-control" placeholder="{{ ++$i }}" aria-describedby="basic-addon1" wire:model='nomor' value="{{ $i }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="exampleFormControlInput1" class="form-label">Tipe Pertanyaan</label>

                                            <div class="ms-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"checked wire:model='tipe' value="a">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Tidak Ada
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" wire:model='tipe' value="p">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Positif
                                                    </label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" wire:model='tipe' value="n">
                                                    <label class="form-check-label" for="flexRadioDefault3">
                                                        Negatif
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm">
                                    <div class="input-group">
                                        <span class="input-group-text">Isi Soal</span>
                                        <textarea class="form-control" aria-label="With textarea" rows="7" wire:model='soal'></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center mt-5 mb-2">
                                @foreach ($opsi_jawaban_dipakai as $opsi)
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" disabled>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                {{ $opsi }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Rekomendasi</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" wire:model='rekomendasi'></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4" style="width: 100%">Tambah Pertanyaan</button>
                        </div>
                    </form>
                </div>
            </ul>

        </main>

    </div>
</div>
