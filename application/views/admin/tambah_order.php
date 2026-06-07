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
      <h3 class="mt-4 mb-3">Tambah Order</h3>
      <div class="card mb-4">
        <div class="card-body">

          <form action="<?= site_url('admin/serada_cru/simpan_order') ?>" method="post" onsubmit="return confirm('Apakah data sudah benar dan ingin disimpan?')">
            <!-- Nama Pemesan -->
            <div class="mb-3">
              <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
              <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan" required>
            </div>

            <!-- Produk Dipesan -->
            <label class="form-label">Produk Dipesan</label>
            <div id="produkContainer">
              <!-- Awal produk -->
              <div class="row mb-2 produk-item">
                <div class="col-md-4">
                  <select name="produk_dipesan[]" class="form-control" onchange="updateHarga(this)" required>
                    <option value="">-- Pilih Produk --</option>
                    <?php foreach ($produk as $row): ?>
                      <option value="<?= $row->nama_produk ?>" data-harga="<?= $row->harga ?>">
                        <?= $row->nama_produk ?> - Rp <?= number_format($row->harga, 0, ',', '.') ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-2">
                  <input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah" value="1" min="1" oninput="hitungTotal()" required>
                </div>
                <div class="col-md-2">
                  <input type="text" class="form-control harga-satuan" readonly>
                  <input type="hidden" name="harga[]" class="harga-hidden">
                </div>
                <div class="col-md-2">
                  <input type="text" class="form-control subtotal" readonly>
                </div>
                <div class="col-md-2">
                  <button type="button" class="btn btn-danger" onclick="hapusProduk(this)">Hapus</button>
                </div>
              </div>
              <!-- Akhir produk -->
            </div>

            <button type="button" class="btn btn-sm btn-outline-success mb-3" onclick="tambahProduk()">+ Tambah Produk</button>

            <!-- Total Harga -->
            <div class="mb-3">
              <label for="total_harga" class="form-label">Total Harga</label>
              <input type="text" name="total_harga" id="total_harga" class="form-control" readonly>
            </div>

            <!-- Pembayaran -->
            <div class="mb-3">
              <label for="pembayaran" class="form-label">Metode Pembayaran</label>
              <select class="form-control" id="pembayaran" name="pembayaran" required>
                <option value="">-- Pilih Pembayaran --</option>
                <option value="Tunai">Tunai</option>
                <option value="Non-Tunai">Non-Tunai</option>
              </select>
            </div>

            <!-- Status -->
            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <select class="form-control" id="status" name="status" required>
                <option value="Belum dibayar">Belum dibayar</option>
                <option value="Sudah dibayar">Sudah dibayar</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?= site_url('admin/serada_cru/lihat_order') ?>" class="btn btn-secondary">Batal</a>
          </form>

          <script>
            function updateHarga(select) {
              const harga = select.options[select.selectedIndex].getAttribute('data-harga');
              const row = select.closest('.produk-item');
              const hargaField = row.querySelector('.harga-satuan');
              const hargaHidden = row.querySelector('.harga-hidden');
              hargaField.value = "Rp " + parseInt(harga).toLocaleString('id-ID');
              hargaHidden.value = harga;
              hitungTotal();
            }

            function hitungTotal() {
              let total = 0;
              const items = document.querySelectorAll('.produk-item');
              items.forEach(item => {
                const harga = parseInt(item.querySelector('.harga-hidden').value || 0);
                const jumlah = parseInt(item.querySelector('input[name="jumlah[]"]').value || 0);
                const subtotal = harga * jumlah;
                item.querySelector('.subtotal').value = "Rp " + subtotal.toLocaleString('id-ID');
                total += subtotal;
              });
              document.getElementById('total_harga').value = "Rp " + total.toLocaleString('id-ID');
            }

            function tambahProduk() {
              const produkContainer = document.getElementById('produkContainer');
              const item = produkContainer.querySelector('.produk-item');
              const clone = item.cloneNode(true);

              // Reset field
              clone.querySelector('select').selectedIndex = 0;
              clone.querySelector('input[name="jumlah[]"]').value = 1;
              clone.querySelector('.harga-satuan').value = '';
              clone.querySelector('.harga-hidden').value = '';
              clone.querySelector('.subtotal').value = '';

              produkContainer.appendChild(clone);
            }

            function hapusProduk(button) {
              const item = button.closest('.produk-item');
              const container = document.getElementById('produkContainer');
              if (container.querySelectorAll('.produk-item').length > 1) {
                item.remove();
                hitungTotal();
              }
            }

            window.addEventListener('DOMContentLoaded', () => {
              const select = document.querySelector('.produk-item select');
              if (select.value !== '') updateHarga(select);
            });
          </script>

        </div>
      </div>
    </div>
  </main>
</div>
