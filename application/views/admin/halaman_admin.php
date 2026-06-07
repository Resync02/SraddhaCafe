<?php

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="
    background-image: url('<?= base_url('assets2/img/bg.jpg') ?>');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    min-height: 100vh;
">

<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4" style="
            background: rgba(255, 255, 255, 0.85);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        ">
            <h1>Sraddha Coffee Management</h1>

            <!-- Waktu Real-time -->
            <div class="mb-4">
                <div class="card shadow p-3">
                    <h5 class="mb-0">Waktu Saat Ini:</h5>
                    <div id="timeDisplay" class="fw-bold fs-5 text-primary">Memuat...</div>
                </div>
            </div>

            <?php
            $jumlah_makanan = 0;
            $jumlah_minuman = 0;
            $makanan_list = [];
            $minuman_list = [];
            foreach ($produk as $p) {
                if (strtolower($p->kategori_produk) == 'makanan') {
                    $jumlah_makanan++;
                    $makanan_list[] = $p;
                }
                if (strtolower($p->kategori_produk) == 'minuman') {
                    $jumlah_minuman++;
                    $minuman_list[] = $p;
                }
            }

            $total_pendapatan = 0;
            $monthly_income = array_fill(1, 12, 0);
            $weekly_income = array_fill(1, 4, 0);
            $yearly_income = [];

            foreach ($order_data ?? [] as $o) {
                $total_pendapatan += $o->total_harga;
                $timestamp = strtotime($o->tanggal);
                $bulan = (int)date('n', $timestamp);
                $minggu = ceil(date('j', $timestamp) / 7);
                $tahun = date('Y', $timestamp);

                $monthly_income[$bulan] += $o->total_harga;
                if ($bulan == date('n')) {
                    $weekly_income[$minggu] += $o->total_harga;
                }
                if (!isset($yearly_income[$tahun])) {
                    $yearly_income[$tahun] = 0;
                }
                $yearly_income[$tahun] += $o->total_harga;
            }
            ?>

            <!-- Statistik Produk -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card border-left-primary shadow h-100 py-2 px-3 clickable" data-bs-toggle="modal" data-bs-target="#modalMakanan">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Produk Makanan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_makanan ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-left-success shadow h-100 py-2 px-3 clickable" data-bs-toggle="modal" data-bs-target="#modalMinuman">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Produk Minuman</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_minuman ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-left-warning shadow h-100 py-2 px-3">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Pendapatan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></div>
                    </div>
                </div>
            </div>

            <!-- Grafik Pendapatan dengan Filter -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Pendapatan</h6>
                    <select id="filterPendapatan" class="form-select w-auto">
                        <option value="bulan" selected>Bulanan</option>
                        <option value="minggu">Mingguan</option>
                        <option value="tahun">Tahunan</option>
                    </select>
                </div>
                <div class="card-body">
                    <canvas id="incomeChart"></canvas>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Makanan -->
    <div class="modal fade" id="modalMakanan" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Daftar Produk Makanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead><tr><th>Gambar</th><th>Nama</th><th>Harga</th><th>Deskripsi</th></tr></thead>
                        <tbody>
                        <?php foreach ($makanan_list as $item): ?>
                            <tr>
                                <td><img src="<?= base_url('assets2/img/' . $item->gambar_produk) ?>" alt="<?= $item->nama_produk ?>" width="80"></td>
                                <td><?= htmlspecialchars($item->nama_produk) ?></td>
                                <td>Rp <?= number_format($item->harga, 0, ',', '.') ?></td>
                                <td><?= htmlspecialchars($item->deskripsi_produk) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Minuman -->
    <div class="modal fade" id="modalMinuman" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Daftar Produk Minuman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead><tr><th>Gambar</th><th>Nama</th><th>Harga</th><th>Deskripsi</th></tr></thead>
                        <tbody>
                        <?php foreach ($minuman_list as $item): ?>
                            <tr>
                                <td><img src="<?= base_url('assets2/img/' . $item->gambar_produk) ?>" alt="<?= $item->nama_produk ?>" width="80"></td>
                                <td><?= htmlspecialchars($item->nama_produk) ?></td>
                                <td>Rp <?= number_format($item->harga, 0, ',', '.') ?></td>
                                <td><?= htmlspecialchars($item->deskripsi_produk) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const incomeData = {
        bulan: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            data: <?= json_encode(array_values($monthly_income)) ?>
        },
        minggu: {
            labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
            data: <?= json_encode(array_values($weekly_income)) ?>
        },
        tahun: {
            labels: <?= json_encode(array_keys($yearly_income)) ?>,
            data: <?= json_encode(array_values($yearly_income)) ?>
        }
    };

    const ctx = document.getElementById('incomeChart').getContext('2d');
    const incomeChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: incomeData['bulan'].labels,
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: incomeData['bulan'].data,
                backgroundColor: 'rgba(78, 115, 223, 0.7)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 1,
                maxBarThickness: 40
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    document.getElementById('filterPendapatan').addEventListener('change', function () {
        const selected = this.value;
        incomeChart.data.labels = incomeData[selected].labels;
        incomeChart.data.datasets[0].data = incomeData[selected].data;
        incomeChart.update();
    });
</script>

<!-- Waktu Real-time -->
<script>
    function updateTime() {
        const now = new Date();
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const dayName = days[now.getDay()];
        const date = now.toLocaleDateString('id-ID', {
            day: 'numeric', month: 'long', year: 'numeric'
        });
        const time = now.toLocaleTimeString('id-ID');

        document.getElementById('timeDisplay').innerText = `${dayName}, ${date} - ${time}`;
    }

    setInterval(updateTime, 1000);
    updateTime();
</script>

</body>
</html>
