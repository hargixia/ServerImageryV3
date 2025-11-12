<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4 p-md-5">

                    <h4 class="text-center mb-4 fw-semibold">
                        Buat Akun {{ config('app.name') }}
                    </h4>

                    <form wire:submit='register_act'>
                        @csrf

                        <!-- Username -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" wire:model='username' placeholder="Masukkan username">
                            </div>
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-person-badge"></i></span>
                                <input type="text" class="form-control" wire:model='nama' placeholder="Masukkan nama lengkap">
                            </div>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-calendar-date"></i></span>
                                <input type="date" class="form-control" wire:model='tanggal_lahir'>
                            </div>
                        </div>

                        <!-- Cabang Olahraga -->
                        <label class="form-label fw-semibold mb-2">Cabang Olahraga</label>
                        <div class="row ms-1 mb-3">
                            @foreach ($data_bidang as $d)
                                <div class="form-check col-6 mb-2">
                                    <input class="form-check-input" type="radio" id="bidang_{{ $d->id }}" wire:model='id_bidang' value="{{ $d->id }}">
                                    <label class="form-check-label small" for="bidang_{{ $d->id }}">
                                        {{ $d->bidang }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Jenis Kelamin -->
                        <label class="form-label fw-semibold mb-2">Jenis Kelamin</label>
                        <div class="ms-1 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="jk_l" wire:model='jenis_kelamin' value="L">
                                <label class="form-check-label" for="jk_l">
                                    <i class="bi bi-gender-male text-primary"></i> Laki-Laki
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="jk_p" wire:model='jenis_kelamin' value="P">
                                <label class="form-check-label" for="jk_p">
                                    <i class="bi bi-gender-female text-danger"></i> Perempuan
                                </label>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" wire:model='password' placeholder="Masukkan password">
                            </div>
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" class="form-control" wire:model='cpassword' placeholder="Ulangi password">
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="row">
                            <div class="col-12 col-md-6 mt-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-check-circle me-1"></i> Buat Akun
                                </button>
                            </div>
                            <div class="col-12 col-md-6 mt-2">
                                <a class="btn btn-outline-primary w-100" href="/login">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali Login
                                </a>
                            </div>
                        </div>

                    </form>

                    <!-- Error Message -->
                    @if(session('error'))
                        <div id="error_msg" class="alert alert-danger text-center mt-4">
                            {{ session('error') }}
                        </div>
                        <script>
                            setTimeout(() => {
                                const msg = document.getElementById('error_msg');
                                if (msg) msg.style.display = 'none';
                            }, 10000);
                        </script>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
