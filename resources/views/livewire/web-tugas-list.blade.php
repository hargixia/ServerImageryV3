<div>
    @foreach ($dtugas as $i => $t)
        <div class=card>
            <div class="card-body">
                <p>{{ $t->nama }}</p>
                <p>{{$dbidang[$i]}}</p>
                <button class="btn btn-primary" wire:click='keDetail({{ $t->id_user }},{{ $md->id }}, 4)'>Lihat</button>
            </div>
        </div>
    @endforeach

</div>
