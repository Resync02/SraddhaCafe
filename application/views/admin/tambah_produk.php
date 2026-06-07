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
      <h3 class="mt-4 mb-3">Tambah Menu</h3>
      <div class="card mb-4">
        <div class="card-body">

          <!-- Script popup konfirmasi -->
          <script>
            function konfirmasiSubmit(event) {
              if (!confirm("Apakah data sudah benar dan ingin disimpan?")) {
                event.preventDefault(); // Batal submit
              }
            }
          </script>

          <!-- Script popup sukses -->
          <?php if (!empty($success)): ?>
            <script>
              alert("<?= $success; ?>");
            </script>
          <?php endif; ?>

          <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
          <?php endif; ?>

          <form action="<?= site_url('admin/serada_cru/tambah_produk') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="nama_produk" class="form-label">Nama Produk</label>
              <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
            </div>

            <div class="mb-3">
              <label for="deskripsi_produk" class="form-label">Deskripsi Produk</label>
              <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" rows="3" required></textarea>
            </div>

            <div class="mb-3">
              <label for="kategori_produk" class="form-label">Kategori Produk</label>
              <select class="form-control" id="kategori_produk" name="kategori_produk" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="harga" class="form-label">Harga Produk</label>
              <input type="number" class="form-control" id="harga" name="harga" required>
            </div>

            <div class="mb-3">
              <label for="gambar_produk" class="form-label">Gambar Produk</label>
              <input class="form-control" type="file" id="gambar_produk" name="gambar_produk" required>
            </div>

            <button type="submit" class="btn btn-primary" onclick="konfirmasiSubmit(event)">Simpan</button>
            <a href="<?= site_url('admin/serada_cru/lihat_data') ?>" class="btn btn-secondary">Batal</a>
          </form>

        </div>
      </div>
    </div>
  </main>
</div>
