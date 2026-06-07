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
            <h1 class="mt-4">Data Order</h1>
            <div class="card mb-4 mx-4 mt-3">
                <div class="card-header">
                    <a href="<?= site_url('admin/serada_cru/tambah_order') ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Order
                    </a>
                    <a href="<?= site_url('admin/serada_cru/laporan') ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-plus"></i> Laporan
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pemesan</th>
                                    <th>Produk Dipesan</th>
                                    <th>Harga</th>
                                    <th>Pembayaran</th>
                                    <th>Total Harga</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($sraddha_order as $order): ?>
                                    <?php
                                        $produk_list = explode("\n", trim($order->produk_dipesan));
                                        $rowspan = count($produk_list);
                                    ?>

                                    <?php for ($i = 0; $i < $rowspan; $i++): ?>
                                        <?php
                                            $nama_produk = '-';
                                            $qty = 0;
                                            $harga = 0;
                                            $sub_total = 0;

                                            $tmp = explode('+', $produk_list[$i]);
                                            if (count($tmp) == 2) {
                                                $nama_produk = trim($tmp[0]);
                                                $qty_harga = explode('|', $tmp[1]);

                                                $qty = isset($qty_harga[0]) ? (int) $qty_harga[0] : 0;
                                                $harga = isset($qty_harga[1]) ? (int) $qty_harga[1] : 0;
                                                $sub_total = $qty * $harga;
                                            }
                                        ?>
                                        <tr>
                                            <?php if ($i == 0): ?>
                                                <td rowspan="<?= $rowspan ?>" style="vertical-align: middle;"><?= $no++ ?></td>
                                                <td rowspan="<?= $rowspan ?>" style="vertical-align: middle;"><?= htmlspecialchars($order->nama_pemesan) ?></td>
                                            <?php endif; ?>

                                            <td><?= htmlspecialchars($nama_produk) . ' x' . $qty ?></td>
                                            <td>Rp <?= number_format($sub_total, 0, ',', '.') ?></td>

                                            <?php if ($i == 0): ?>
                                                <td rowspan="<?= $rowspan ?>" style="vertical-align: middle;">
                                                    <?= htmlspecialchars($order->pembayaran) ?>
                                                </td>
                                                <td rowspan="<?= $rowspan ?>" style="vertical-align: middle;">
                                                    Rp <?= number_format($order->total_harga, 0, ',', '.') ?>
                                                </td>
                                                <td rowspan="<?= $rowspan ?>" style="vertical-align: middle;">
                                                    <?= date('d-m-Y', strtotime($order->tanggal)) ?>
                                                </td>
                                                <td rowspan="<?= $rowspan ?>" style="vertical-align: middle;">
                                                    <span class="badge <?= ($order->status == 'Sudah dibayar') ? 'bg-success' : 'bg-warning text-dark' ?>">
                                                        <?= $order->status ?>
                                                    </span>
                                                    <?php if ($order->status == 'Belum dibayar'): ?>
                                                        <div class="mt-1">
                                                            <a href="<?= base_url('admin/serada_cru/ubah_status/' . $order->id_order); ?>" class="btn btn-sm btn-success">
                                                                Tandai Lunas
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td rowspan="<?= $rowspan ?>" style="vertical-align: middle;">
                                                    <a href="<?= base_url('admin/serada_cru/delete_order/' . $order->id_order); ?>" 
                                                       class="btn btn-sm btn-danger" 
                                                       onclick="return confirm('Yakin ingin menghapus order ini?')">
                                                        Hapus
                                                    </a>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endfor; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Script untuk inisialisasi DataTables -->
            <script>
                $(document).ready(function () {
                    $('#dataTable').DataTable({
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/English.json"
                        }
                    });
                });
            </script>
        </div>
            </div>
    </main>
</div>
