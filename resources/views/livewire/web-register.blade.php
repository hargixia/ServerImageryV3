<div class="d-flex justify-content-center">
    <div class="card" style="width:50%;margin-top:3%">
      <div class="card-body">

        <div class="row">
            <div class="col-sm-7">

            </div>

            <div class="col-sm-5">
                <h3 class="text-center"> Buat Akun Untuk Aplikasi {{ config('app.name') }} </h3>
                <form class="mt-4" wire:submit='register_act'>
                    @csrf
                    <div class="mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" class="form-control" wire:model='username'>
                    </div>

                    <div class="mb-3">
                      <label for="nama" class="form-label">Nama Lengkap</label>
                      <input type="text" class="form-control" wire:model='nama'>
                    </div>

                    <div class="mb-3">
                      <label for="tgl" class="form-label">Tanggal Lahir</label>
                      <input type="date" class="form-control" wire:model='tanggal_lahir'>
                    </div>

                    <label class="form-label mb-3">
                            Cabang Olahraga
                    </label>

                    <div class="row ms-2 mb-3">

                        @foreach ($data_bidang as $d)
                            <div class="form-check col-sm-6">
                                <input class="form-check-input" type="radio" id="flexRadioDefault1" wire:model='id_bidang' value="{{ $d->id }}">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    {{ $d->nama }}
                                </label>
                            </div>

                        @endforeach

                    </div>

                    <label class="form-label mb-3">
                            Jenis Kelamin
                    </label>

                    <div class="col ms-2 mb-3">
                        <div class="form-check row-sm-6">
                            <input class="form-check-input" type="radio" id="flexRadioDefault1" wire:model='jenis_kelamin' value="L">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Laki-Laki
                            </label>
                        </div>

                        <div class="form-check row-sm-6">
                            <input class="form-check-input" type="radio" id="flexRadioDefault1" wire:model='jenis_kelamin' value="P">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Perempuan
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" class="form-control" id="password" wire:model='password'>
                    </div>

                    <div class="mb-3">
                      <label for="password" class="form-label">Konfirmasi Password</label>
                      <input type="password" class="form-control" id="password" wire:model='cpassword'>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 mt-2">
                            <button type="submit" style="width: 100%" class="btn btn-primary">Buat Akun</button>
                        </div>
                        <div class="col-sm-6 mt-2">
                            <a style="width: 100%" class="btn btn-outline-primary" href="/login">Kembali Login</a>
                        </div>
                    </div>

                </form>

                @if(session('error'))
                        <div id="error_msg" class="badge bg-danger fs-6 mt-3" style="width: 100%;overflow: hidden;text-overflow: -o-ellipsis-lastline;white-space: normal">
                            {{ session('error') }}
                        </div>
                        <script>
                            setTimeout(function() {
                                var errorMsg = document.getElementById('error_msg');
                                if (errorMsg) {
                                    errorMsg.style.display = 'none';
                                }
                            }, 10000);
                        </script>
                    @endif

            </div>
        </div>

      </div>
    </div>
</div>
