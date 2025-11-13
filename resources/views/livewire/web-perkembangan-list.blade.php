<div>
    @foreach ($listUser as $lu)
        <div class="card m-3">
            <div class="card-body">
                <p>{{$lu->nama}}</p>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary"  wire:click='tampilkan({{ $lu->id }})'>
                Launch static backdrop modal
                </button>
            </div>
        </div>
    @endforeach

</div>
