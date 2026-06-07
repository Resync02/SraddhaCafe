<body style="
    background-image: url('<?= base_url('assets2/img/bg.jpg') ?>');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    min-height: 100vh;
">
<div id="layoutSidenav_content">
        <div class="container mt-4" style="
            background: rgba(255, 255, 255, 0.85);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        ">
    <h2 class="mb-4">Laporan Pendapatan</h2>
    <div class="card mb-4">
        <div class="card-body">
            <form action="<?= site_url('admin/serada_cru/laporan') ?>" method="get" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="filter" class="form-label">Pilih Jenis Laporan</label>
                    <select class="form-select" name="filter" id="filter" required onchange="toggleFilterInputs()">
                        <option value="">-- Pilih --</option>
                        <option value="harian" <?= ($_GET['filter'] ?? '') == 'harian' ? 'selected' : '' ?>>Harian</option>
                        <option value="mingguan" <?= ($_GET['filter'] ?? '') == 'mingguan' ? 'selected' : '' ?>>Mingguan</option>
                        <option value="bulanan" <?= ($_GET['filter'] ?? '') == 'bulanan' ? 'selected' : '' ?>>Bulanan</option>
                        <option value="tahunan" <?= ($_GET['filter'] ?? '') == 'tahunan' ? 'selected' : '' ?>>Tahunan</option>
                    </select>
                </div>

                <!-- Harian -->
                <div class="col-md-3" id="input-harian" style="display:none;">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= $_GET['tanggal'] ?? '' ?>">
                </div>

                <!-- Mingguan -->
                <div class="col-md-3" id="input-mingguan" style="display:none;">
                    <label class="form-label">Dari Tanggal</label>
                    <input type="date" name="start" class="form-control" value="<?= $_GET['start'] ?? '' ?>">
                </div>
                <div class="col-md-3" id="input-mingguan-end" style="display:none;">
                    <label class="form-label">Sampai Tanggal</label>
                    <input type="date" name="end" class="form-control" value="<?= $_GET['end'] ?? '' ?>">
                </div>

                <!-- Bulanan -->
                <div class="col-md-3" id="input-bulanan" style="display:none;">
                    <label class="form-label">Bulan</label>
                    <select name="bulan" class="form-select">
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            $selected = ((int)($_GET['bulan'] ?? 0) === $i) ? 'selected' : '';
                            echo "<option value=\"$i\" $selected>" . date('F', mktime(0, 0, 0, $i, 10)) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3" id="input-bulanan-tahun" style="display:none;">
                    <label class="form-label">Tahun</label>
                    <input type="number" name="tahun" class="form-control" value="<?= $_GET['tahun'] ?? date('Y') ?>">
                </div>

                <!-- Tahunan -->
                <div class="col-md-3" id="input-tahunan" style="display:none;">
                    <label class="form-label">Tahun</label>
                    <input type="number" name="tahun_tahunan" class="form-control" value="<?= $_GET['tahun_tahunan'] ?? date('Y') ?>">
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
                </div>
                <div>
                                    <a href="<?= site_url('admin/serada_cru/export_pdf?' . $_SERVER['QUERY_STRING']) ?>" target="_blank" class="btn btn-danger">
                    <i class="fa fa-file-pdf"></i> Cetak PDF
                </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Hasil -->
    <div class="card">
        <div class="card-header bg-dark text-white fw-bold">Hasil Laporan</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Produk</th>
                        <th>Pembayaran</th>
                        <th>Total Harga</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    if (!empty($hasil)) {
                        $no = 1;
                        foreach ($hasil as $r) {
                            $total += $r->total_harga;
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($r->nama_pemesan) ?></td>
                                <td><pre class="mb-0"><?= htmlspecialchars($r->produk_dipesan) ?></pre></td>
                                <td><?= htmlspecialchars($r->pembayaran) ?></td>
                                <td>Rp <?= number_format($r->total_harga, 0, ',', '.') ?></td>
                                <td><?= date('d/m/Y', strtotime($r->tanggal)) ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="6" class="text-center">Belum ada data</td></tr>';
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Total Pendapatan</th>
                        <th colspan="2">Rp <?= number_format($total, 0, ',', '.') ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
function toggleFilterInputs() {
    const filter = document.getElementById('filter').value;

    document.getElementById('input-harian').style.display = (filter === 'harian') ? 'block' : 'none';
    document.getElementById('input-mingguan').style.display = (filter === 'mingguan') ? 'block' : 'none';
    document.getElementById('input-mingguan-end').style.display = (filter === 'mingguan') ? 'block' : 'none';
    document.getElementById('input-bulanan').style.display = (filter === 'bulanan') ? 'block' : 'none';
    document.getElementById('input-bulanan-tahun').style.display = (filter === 'bulanan') ? 'block' : 'none';
    document.getElementById('input-tahunan').style.display = (filter === 'tahunan') ? 'block' : 'none';
}

// Jalankan saat halaman dimuat
document.addEventListener('DOMContentLoaded', toggleFilterInputs);
</script>
