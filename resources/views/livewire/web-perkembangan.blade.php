<div class="container-fluid p-0">
    <div class="row g-0">

        <!-- SIDEBAR -->
        <div class="col-2 bg-light border-end p-3 d-none d-md-block"
             style="position: sticky; top: 80px; height: calc(100vh - 80px); overflow-y:auto;">
            <aside>
                @include('components.navbar')
            </aside>
        </div>

        <!-- MAIN CONTENT -->
        <main class="col-12 col-md-10 p-4">

            <!-- HEADER -->
            <div class="mb-4">
                <h1 class="fw-bold text-primary">{{ $materi->judul }}</h1>
                <h5 class="text-secondary">
                    Bidang: <span class="fw-semibold">{{ $bidang->bidang }}</span>
                </h5>
            </div>

            <!-- CARD INFORMASI -->
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-body">
                    <p><strong>Nama:</strong> {{ $user->nama }}</p>
                    <p><strong>Umur:</strong> {{ $umur }} tahun</p>
                    <p><strong>Bidang:</strong> {{ $user_bidang->bidang }}</p>
                    <p><strong>Jumlah Soal Yang Dikerjakan:</strong> {{ count($data_kuisoner) }}</p>
                    <p><strong>Rata-Rata Nilai:</strong> {{ $rata_nilai }}</p>
                    <p><strong>Kategori:</strong> {{ $rata_kategori }}</p>
                </div>
            </div>

            <!-- GRAFIK -->
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h5 class="mb-0">Grafik Perkembangan Anda</h5>
                </div>

                <div class="card-body">
                    <canvas id="myChart" class="w-100" style="max-height: 350px;"></canvas>
                </div>
            </div>

            <!-- HISTORI -->
            <h4 class="fw-bold mb-3">Riwayat Pengerjaan</h4>

            @foreach ($data_kuisoner as $i => $dk)
                @php $daten = new DateTime($dk->created_at); @endphp

                <div class="card shadow-sm border-0 rounded-4 mb-3">
                    <div class="card-body">

                        <div class="row text-center text-md-start">
                            <div class="col-md-1 fw-bold fs-4 text-primary">
                                {{ $i + 1 }}
                            </div>

                            <div class="col-md-4 mb-2">
                                <p class="mb-1"><strong>Dilakukan Pada:</strong> {{ $daten->format('d F Y, H:i:s') }}</p>
                                <p class="mb-1"><strong>Hari:</strong> {{ $daten->format('l') }}</p>
                            </div>

                            <div class="col-md-3 mb-2">
                                <p class="mb-1"><strong>Nilai:</strong></p>
                                <p class="fs-5 fw-bold">{{ $dk->nilai }}</p>
                            </div>

                            <div class="col-md-2 mb-2">
                                <p class="mb-1"><strong>Kategori:</strong></p>
                                <span class="badge bg-info text-dark px-3 py-2">
                                    {{ $dk->kategori }}
                                </span>
                            </div>

                            <div class="col-md-2">
                                <p class="mb-1"><strong>Rekomendasi:</strong></p>
                                <p class="text-secondary small">{{ $dk->rekomendasi }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

        </main>

    </div>
</div>

<!-- CHART JS -->
<script>
    @php
        $points = [];
        $labels = [];
        foreach ($data_kuisoner as $index => $dk) {
            $points[] = $dk->nilai;
            $labels[] = $index + 1;
        }
    @endphp

    const yValues = @json($points);
    const xValues = @json($labels);

    new Chart(document.getElementById('myChart'), {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
                label: "Nilai Anda",
                fill: false,
                tension: 0.3,
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 3,
                pointBackgroundColor: "rgba(54, 162, 235, 1)",
                data: yValues
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true },
                title: {
                    display: true,
                    text: "Perkembangan Nilai Anda",
                    font: { size: 16 }
                }
            },
            scales: {
                y: {
                    min: 0,
                    max: 100,
                    ticks: { stepSize: 10 }
                }
            }
        }
    });
</script>
