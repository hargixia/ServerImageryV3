<div class="container-fluid">

    <div class="row mt-2">
        <div class="col-2">
            <aside class="sticky-top">
                @include('components.navbar')
            </aside>
        </div>

        <main class="col-10">
            <h1 class="mt-3">Daftar Pengguna</h1>

            @foreach ($pengguna as $p)
                <ul class="list-group">
                    <li class="card mb-2">
                        <div class="card-body">
                            <h5 class="card-title">{{ $p->nama }}</h5>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" wire:click='currentUser({{ $p->id }})'>click</button>
                        </div>
                    </li>
                </ul>
            @endforeach

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ $user_id }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
            </div>

        </main>

    </div>
</div>
