<div>
    {{ $materiNow->judul }}

    {{ $materiNow->deskripsi }}

    {{ $materiNow->tipe }}

    @if($materiNow->tipe == 'teks')
        <div class="mt-3">
            {!! $materiNow->isi !!}
        </div>
    @elseif($materiNow->tipe == 'video')
        <div class="mt-3">
            <video width="100%" height="400" controls>
                <source src="{{ asset('images/materi/' . $materiNow->isi) }}" type="video/mp4">
            </video>
        </div>
    @elseif($materiNow->tipe == 'gambar')
        <div class="mt-3 text-center">
            <img src="{{ asset('images/materi/' . $materiNow->isi) }}" alt="{{ $materiNow->judul }}" class="img-fluid">
        </div>
    @elseif ($materiNow->tipe == 'audio')
        <div class="mt-3">
            <audio controls>
                <source src="{{ asset('images/materi/' . $materiNow->isi) }}" type="audio/mpeg">
            </audio>
        </div>
    @else
        <div class="mt-3">
            TIdak Ada Isi
        </div>
    @endif


    <button type="button" wire:click='kembali' class="btn btn-secondary mt-4">
        Kembali
    </button>

</div>
