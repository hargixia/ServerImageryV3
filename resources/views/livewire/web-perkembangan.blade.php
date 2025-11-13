<div>
    perkembangan

    <h1>
        <p>judul : {{ $materi->judul }}</p>
        <p>bidang : {{$bidang->bidang}}</p>
    </h1>

    <div class="card">
        <div class="card-body">
            <p>Nama : {{$user->nama}}</p>
            <p>Umur : {{ $umur }} tahun</p>
            <p>Bidang : {{$user_bidang->bidang}}</p>
            <p>Jumlah Soal Yang di Kerjakan : {{count($data_kuisoner)}}</p>
            <p>Rata-Rata Nilai : {{$rata_nilai}}</p>
            <p>Kategori : {{$rata_kategori}}</p>
        </div>
    </div>

    <h4 class="mt-3">Grafik Perkembangan Anda</h4>
    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

    <h4>List Data Histori Anda</h4>
    @foreach ($data_kuisoner as $i=> $dk)
        <div class="card mb-2">
            <div class="card-body">
                <div class="row">
                    <div class='col'>
                        {{ $i+1 }}
                    </div>
                    <div class='col'>
                        @php
                            $daten = new datetime($dk->created_at);
                        @endphp

                        <div class="col">
                            <div class="row">
                                Dilakukan Pada: {{$daten->format('d - F - Y, H:i:s') }}
                            </div>
                            <div class="row">
                                Hari : {{ $daten->format('l') }}
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="row">
                            Nilai:
                        </div>
                        <div class="row">
                            {{ $dk->nilai }}
                        </div>
                    </div>

                    <div class="col">
                        <div class="row">
                            Kategori
                        </div>
                        <div class="row">
                            {{ $dk->kategori }}
                        </div>
                    </div>

                </div>
                <div class="card-subtitle">
                    <div class="row">
                        <div class="col">

                        </div>
                        <div class="col">
                            Rekomendasi:
                        </div>

                        <div class="col">
                            {{ $dk->rekomendasi }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        let xValues = [];
        let yValues = [];
        @for ($i = 0;$i < count($data_kuisoner);$i++)
            yValues.push({{ $data_kuisoner[$i]->nilai }});
            xValues.push({{ $i }});
        @endfor

        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
        type: "line",
        data: {
            labels: xValues,
            datasets: [{
            fill: false,
            lineTension: 0,
            backgroundColor: "rgba(0,0,255,1.0)",
            borderColor: "rgba(0,0,255,0.1)",
            data: yValues
            }]
        },
        options: {
            plugins: {
            legend: {display:false},
            title: {
                display: true,
                text: "House Prices vs. Size",
                font: {size:16}
            }
            }
        }
        });
    </script>
</div>
