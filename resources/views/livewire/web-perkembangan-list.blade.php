<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- SIDEBAR -->
        <div class="col-2 bg-light border-end p-3 d-none d-md-block"
             style="position: sticky; top: 80px; height: calc(100vh - 80px); overflow-y: auto;">
            <aside>
                @include('components.navbar')
            </aside>
        </div>

        <!-- MAIN -->
        <main class="col-12 col-lg-10 p-4">

            <h1 class="mb-4 fw-bold text-primary">Daftar Performa Siswa</h4>

            @foreach ($listUser as $i => $lu)
                <div class="card shadow-sm mb-3 w-100 p-3">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">

                        <!-- INFO USER -->
                        <div class="text-center text-md-start mb-3 mb-md-0">
                            <h5 class="fw-bold mb-1">{{ $lu->nama }}</h5>
                            <p class="mb-0 text-muted">Bidang : {{ $dbidang[$i] }}</p>
                            <p class="mb-0 text-muted">Soal dikerjakan: {{ $soal_dikerjakan[$i] }}</p>
                            <p class="mb-0 text-muted">Rata-rata nilai: {{ $rata2nilai[$i] }}</p>
                        </div>

                        <!-- STATUS PERFORMA -->
                        <div class="text-center text-md-start mb-3 mb-md-0">
                            <span class="badge
                                @if($performa[$i] == 'baik') bg-success
                                @elseif($performa[$i] == 'cukup') bg-warning
                                @else bg-danger @endif
                                px-3 py-2">
                                Status: {{ ucfirst($performa[$i]) }}
                            </span>
                        </div>

                        <!-- DETAIL BUTTON -->
                        <div class="text-center">
                            <a wire:click='tampilkan({{ $lu->id }})' class="btn btn-primary mt-2 mt-md-0">
                                Detail Performa
                            </a>
                        </div>

                    </div>

                </div>
            @endforeach


        </main>
    </div>
</div>
