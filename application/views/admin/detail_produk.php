<div id="layoutSidenav_content">
<div class="container mt-4">
    <h2>Detail Menu</h2>
    <div class="card" style="width: 20rem;">
        <img src="<?= base_url('assets2/img/' . $produk->gambar_produk) ?>" class="card-img-top" alt="<?= $produk->nama_produk ?>">
        <div class="card-body">
            <h5 class="card-title"><?= $produk->nama_produk ?></h5>
            <p class="card-text"><?= $produk->deskripsi_produk ?></p>
            <p class="card-text"><strong>Kategori:</strong> <?= $produk->kategori_produk ?></p>
            <p class="card-text"><strong>Harga:</strong> Rp <?= number_format($produk->harga, 0, ',', '.') ?></p>
            <a href="<?= site_url('admin/serada_cru/halaman_admin') ?>" class="btn btn-secondary mt-2">Kembali</a>
        </div>
    </div>
</div>
