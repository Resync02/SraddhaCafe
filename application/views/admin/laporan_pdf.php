<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pendapatan - Serada Kopi</title>
</head>
<body>

<div class="kop">
    <h2>LAPORAN PENDAPATAN</h2>
    <h3>Serada Kopi</h3>
    <p>Jl. Pariwisata Raya No 12 RT.001/RW.008, Pengasinan, Kec. Rawalumbu,<br>Kota Bks, Jawa Barat 17115</p>
</div>

<div class="meta">
    <table>
        <tr>
            <td><strong>Periode:</strong></td>
            <td>
                <?php
                $filter = $_GET['filter'] ?? '';
                if ($filter == 'harian' && !empty($_GET['tanggal'])) {
                    echo 'Tanggal ' . date('d F Y', strtotime($_GET['tanggal']));
                } elseif ($filter == 'mingguan' && !empty($_GET['start']) && !empty($_GET['end'])) {
                    echo 'Mingguan (' . date('d F Y', strtotime($_GET['start'])) . ' - ' . date('d F Y', strtotime($_GET['end'])) . ')';
                } elseif ($filter == 'bulanan' && !empty($_GET['bulan']) && !empty($_GET['tahun'])) {
                    echo date('F', mktime(0, 0, 0, $_GET['bulan'], 10)) . ' ' . $_GET['tahun'];
                } elseif ($filter == 'tahunan' && !empty($_GET['tahun_tahunan'])) {
                    echo 'Tahun ' . $_GET['tahun_tahunan'];
                } else {
                    echo 'Semua Periode';
                }
                ?>
            </td>
        </tr>
        <tr>
            <td><strong>Tanggal Cetak:</strong></td>
            <td><?= date('d-m-Y') ?></td>
        </tr>
    </table>
</div>

<table class="laporan">
    <thead>
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
                    <td style="text-align:center;"><?= $no++ ?></td>
                    <td><?= htmlspecialchars($r->nama_pemesan) ?></td>
                    <td><?= nl2br(htmlspecialchars($r->produk_dipesan)) ?></td>
                    <td style="text-transform:capitalize;"><?= htmlspecialchars($r->pembayaran) ?></td>
                    <td style="text-align:right;">Rp <?= number_format($r->total_harga, 0, ',', '.') ?></td>
                    <td style="text-align:center;"><?= date('d/m/Y', strtotime($r->tanggal)) ?></td>
                </tr>
                <?php
            }
        } else {
            echo '<tr><td colspan="6" style="text-align:center;">Tidak ada data.</td></tr>';
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4" style="text-align:right;">Total Pendapatan</th>
            <th colspan="2" style="text-align:right;">Rp <?= number_format($total, 0, ',', '.') ?></th>
        </tr>
    </tfoot>
</table>

<div class="footer">
    Dicetak oleh sistem Sraddha Coffee
</div>

<!-- CSS di bawah sini -->
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        color: #333;
        margin: 40px;
    }
    .kop {
        text-align: center;
        border-bottom: 2px solid #000;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    .kop h2 {
        margin: 0;
        font-size: 20px;
        font-weight: bold;
    }
    .kop h3 {
        margin: 0;
        font-size: 16px;
        font-weight: normal;
    }
    .kop p {
        margin: 5px 0 0;
        font-size: 12px;
    }
    .meta {
        margin-bottom: 20px;
    }
    .meta table {
        width: 100%;
    }
    .meta td {
        padding: 5px 0;
    }
    table.laporan {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    table.laporan th, table.laporan td {
        border: 1px solid #000;
        padding: 8px;
    }
    table.laporan th {
        background-color: #f0f0f0;
        text-align: center;
    }
    table.laporan td {
        vertical-align: top;
    }
    table.laporan tfoot th {
        background-color: #f9f9f9;
        font-weight: bold;
    }
    .footer {
        margin-top: 40px;
        text-align: right;
        font-style: italic;
    }
</style>

</body>
</html>
