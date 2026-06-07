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
        ">            <h3 class="mt-4 mb-3">Edit Menu</h3>

            <div class="card mb-4">
                <div class="card-body">

                    <!-- Tampilkan error upload kalau ada -->
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return confirm('Apakah data sudah benar dan ingin disimpan?')">
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="<?= $produk->nama_produk ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_produk" class="form-label">Deskripsi Produk</label>
                            <textarea name="deskripsi_produk" id="deskripsi_produk" class="form-control" required><?= $produk->deskripsi_produk ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="kategori_produk" class="form-label">Kategori Produk</label>
                            <input type="text" name="kategori_produk" id="kategori_produk" class="form-control" value="<?= $produk->kategori_produk ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga Produk</label>
                            <input type="number" name="harga" id="harga" class="form-control" value="<?= $produk->harga ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="gambar_produk" class="form-label">Gambar Produk</label>
                            <input type="file" name="gambar_produk" id="gambar_produk" class="form-control">
                            <?php if (!empty($produk->gambar_produk)): ?>
                                <div class="mt-2">
                                    <img src="<?= base_url('assets2/img/' . $produk->gambar_produk) ?>" width="120" alt="Gambar Produk">
                                </div>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="<?= site_url('admin/serada_cru/lihat_data') ?>" class="btn btn-secondary">Kembali</a>
                    </form>

                </div>
            </div>
        </div>
    </main>
</div>
