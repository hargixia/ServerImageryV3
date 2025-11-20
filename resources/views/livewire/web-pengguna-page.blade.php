<div class="container-fluid p-0">
    <div class="row g-0">

        <!-- SIDEBAR -->
        <div class="col-2 bg-light border-end p-3 d-none d-md-block"
             style="position: sticky; top: 80px; height: calc(100vh - 80px); overflow-y: auto;">
            <aside>
                @include('components.navbar')
            </aside>
        </div>

        <!-- MAIN CONTENT -->
        <main class="col-12 col-lg-10 p-4">
            <!-- FORM WRAPPER -->
            <div class="d-flex justify-content-center">
                <form class="card shadow-lg border-0 rounded-4 p-4 w-100" style="max-width: 650px;"
                      wire:submit.prevent='simpanData'>

                    <div class="card-body">
                        <div class="mb-3 text-center">
                            <h3 class="fw-bold text-primary">
                                 {{$title}}
                            </h3>
                        </div>
                        <hr class="mb-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-person-circle me-1"></i> Username
                            </label>
                            <input type="text" class="form-control rounded-3" wire:model="username">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-person-badge me-1"></i> Nama Lengkap
                            </label>
                            <input type="text" class="form-control rounded-3" wire:model="nama">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-calendar-date me-1"></i> Tanggal Lahir
                            </label>
                            <input type="date" class="form-control rounded-3" wire:model="tanggal_lahir">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold d-block mb-1">
                                <i class="bi bi-gender-ambiguous me-1"></i> Jenis Kelamin
                            </label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="L" wire:model="jenis_kelamin">
                                <label class="form-check-label">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="P" wire:model="jenis_kelamin">
                                <label class="form-check-label">Perempuan</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-shield-lock me-1"></i> Role
                            </label>
                            <select class="form-select rounded-3" wire:model="id_role">
                                <option value="">Pilih...</option>
                                @foreach ($d_role as $r)
                                    <option value="{{ $r->id }}">{{ $r->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-layers me-1"></i> Bidang
                            </label>

                            @foreach ($d_bidang as $d)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" wire:model="id_bidang" value="{{ $d->id }}">
                                    <label class="form-check-label">{{ $d->bidang }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-key me-1"></i> Password
                            </label>
                            <input type="password" class="form-control rounded-3" wire:model="password">
                        </div>

                    </div>

                    <!-- BUTTONS -->
                    <div class="d-flex justify-content-between mt-3">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold">
                            <i class="bi bi-check-circle me-1"></i> Simpan
                        </button>

                        <button type="button" class="btn btn-danger rounded-pill px-4 fw-semibold"
                                wire:click='kembali'>
                            <i class="bi bi-x-circle me-1"></i> Batalkan
                        </button>
                    </div>

                </form>
            </div>

        </main>
    </div>
</div>
