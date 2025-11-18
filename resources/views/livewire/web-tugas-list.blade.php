<div>
    {{-- The whole world belongs to you. --}}

    @foreach ($dtugas as $t)
        <div class=card>
            <div class="card-body">
                {{ $t->nama }}
                <button class="btn btn-primary" wire:click='keDetail({{ $t->id_user }},{{ $md->id }}, 4)'>Lihat</button>
            </div>
        </div>
    @endforeach

</div>
