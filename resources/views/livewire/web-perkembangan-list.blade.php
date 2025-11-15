<div>
    @foreach ($listUser as $i => $lu)
        <div class="card m-3">
            <div class="card-body">
                <p>{{$lu->nama}}</p>
                <p>soal dikerjakan {{ $soal_dikerjakan[$i] }}</p>
                <p>Rata2 = {{$rata2nilai[$i]}}</p>
                <p>{{json_encode($performa[$i])}}</p>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary"  wire:click='tampilkan({{ $lu->id }})'>
                Launch static backdrop modal
                </button>
            </div>
        </div>
    @endforeach

</div>
