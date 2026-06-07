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
        <h1 class="mt-4">Table Menu</h1>
            <div class="card mb-4 mx-4 mt-3">
                <div class="card-header">
                    <a href="<?php echo site_url('admin/serada_cru/tambah_produk') ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-plus"></i> Add Data
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="datatablesSimple" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Deskripsi</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($produk as $row) {
                                ?>
                                    <tr>
                                        <td><?= $row->id ?></td>
                                        <td><?= $row->nama_produk ?></td>
                                        <td><?= $row->deskripsi_produk ?></td>
                                        <td><?= $row->kategori_produk ?></td>
                                        <td>Rp <?= number_format($row->harga, 0, ',', '.') ?></td>
                                        <td>
                                            <img src="<?= base_url('assets2/img/' . $row->gambar_produk); ?>" width="200" height="150" style="object-fit: cover; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                                        </td>
                                        <td>
                                            <a href="<?= site_url('admin/serada_cru/edit_product/' . $row->id) ?>" class="btn btn-outline-primary btn-sm mb-1">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <br>
                                            <a href="<?= site_url('admin/serada_cru/delete_product/' . $row->id) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                        <!-- script memanggil cdn datatables -->
                        <script>
                            $(document).ready(function() {
                                $('#dataTable').DataTable({
                                    "language": {
                                        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/English.json"
                                    }
                                });
                            });
                        </script>
                           </div>
                    </main>
                        
