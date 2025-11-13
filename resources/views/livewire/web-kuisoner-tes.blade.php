<div>
    @if (Auth::check() && Auth::user()->nama)
        @include('components.header')
    @endif  
    @if (count($kuisoner) <=0)
        <div class="alert alert-warning text-center" role="alert">
            Tidak ada kuisoner tersedia untuk materi ini.
        </div>
    @else
        @foreach ($kuisoner as $k)
            <div class="card m-3">
                <div class="card-body">
                    <h5 class="card-title">Soal Nomor {{ $k->no }}</h5>
                    <p class="card-text">{{ $k->soal }}</p>
                    <div class='row ms-5 mt-5'>
                        @foreach ($opsi as $i => $o)
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" wire:click='jawab({{ $k->id }}, "{{ $i+1 }}")'>
                                    <label class="form-check-label" for="flexRadioDefault1" >
                                        {{ $o }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <button type="button" wire:click='kirimJawaban' data-bs-toggle="modal" data-bs-target="#exampleModal">Kirim Jawaban</button>

    <p>
        {{ json_encode($jawaban) }}
    </p>

    @if ($kirim != null)
        Selamat kamu telah menyelesaikan 
    @endif

</div>
