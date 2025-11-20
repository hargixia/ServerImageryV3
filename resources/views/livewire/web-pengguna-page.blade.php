<div>

    <form class="card" wire:submit='simpanData'>
        <div class="card-header">
            <h3 class="card-title">{{$title}}</h3>
        </div>
        <div class="card-body">

            <div class="col-md-6">
                <label class="form-label">Username</label>
                    <input type="text" class="form-control" wire:model="username">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" wire:model="nama">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" wire:model="tanggal_lahir">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Jenis Kelamin</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="L" wire:model="jenis_kelamin"> Laki-laki
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" value="P" wire:model="jenis_kelamin"> Perempuan
                    </div>
                </div>

                {{ $id_role }}

                <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <select class="form-select" wire:model="id_role">
                        <option value="">Pilih...</option>
                        @foreach ($d_role as $r)
                            <option value="{{ $r->id }}" @if($id_role == $r->id) selected @endif>{{$r->nama}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Bidang</label>
                    @foreach ($d_bidang as $d)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" wire:model='id_bidang' value="{{ $d->id }}">
                            <label class="form-check-label">{{ $d->bidang }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" wire:model="password">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="#" class="btn btn-danger" wire:click='kembali'>Batalkan</a>
        </div>
    </form>
</div>
