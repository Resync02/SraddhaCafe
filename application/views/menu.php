<section class="about_section layout_padding">
  <div class="container">
    <div class="row">
      <!-- Gambar Menu 1 -->
      <div class="col-md-6">
        <div class="img-box">
          <img src="<?php echo base_url('assets/images/Menu1.jpg'); ?>" alt="Menu Image" style="max-width: 100%; border-radius: 10px;">
        </div>
      </div>

      <!-- Gambar Menu 2 -->
      <div class="col-md-6">
        <div class="img-box">
          <img src="<?php echo base_url('assets/images/Menu2.jpg'); ?>" alt="Menu Image" style="max-width: 100%; border-radius: 10px;">
        </div>
      </div>

      <!-- SwiperJS CSS -->
      <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

      <!-- Slider Gambar -->
      <div class="col-12 mt-4 d-flex justify-content-center">
        <div class="swiper-container" style="max-width: 300px;">
          <div class="swiper-wrapper">
            <?php foreach ($menu_images as $image): ?>
              <div class="swiper-slide" style="
                  width: 250px;
                  height: 500px;
                  overflow: hidden;
                  border-radius: 10px;
                  box-shadow: 0 0 10px rgba(0,0,0,0.3);
                  display: flex;
                  align-items: center;
                  justify-content: center;
                ">
                <img 
                  src="<?= base_url('assets2/img/' . $image->gambar_produk) ?>" 
                  alt="<?= html_escape($image->nama_produk) ?>" 
                  style="
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    border-radius: 0;
                    cursor: pointer;
                  "
                  data-nama="<?= html_escape($image->nama_produk) ?>"
                  data-deskripsi="<?= html_escape($image->deskripsi_produk) ?>"
                >
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <!-- Modal Zoom Gambar & Detail -->
      <div class="modal fade" id="zoomModal" tabindex="-1" role="dialog" aria-labelledby="zoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content shadow" style="background: #222831; border: 3px solid #000; border-radius: 40px;">
            <div class="modal-body d-flex justify-content-center align-items-center text-center flex-wrap" style="gap: 30px; padding: 30px;">
              <!-- Gambar Produk -->
              <img id="zoomedImage" src="" class="img-fluid" style="max-height: 300px; border-radius: 12px;">
              
              <!-- Nama & Deskripsi Produk -->
              <div style="text-align: left; max-width: 400px;">
                <h3 id="productName" style="color: white; margin-bottom: 15px; font-size: 28px; font-family: 'Poppins', sans-serif;"></h3>
                <p id="productDesc" style="color: white; font-size: 18px; font-family: 'Open Sans', sans-serif;"></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Detail Menu -->
      <div class="col-md-6 mt-4">
        <div class="detail-box">
          <div class="heading_container">
            <h2>Our Menu</h2>
          </div>
          <p>
            SRADDHA COFFEE menghadirkan beragam pilihan minuman kopi klasik hingga signature drink khas yang diracik dengan cita rasa unik. Tersedia juga varian non-kopi dan camilan ringan untuk melengkapi suasana nongkrong Anda. Setiap sajian dirancang untuk memberi pengalaman rasa yang konsisten dan berkesan, sesuai dengan karakter tempatnya yang otentik.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SwiperJS Script -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
  var swiper = new Swiper('.swiper-container', {
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 'auto',
    loop: true,
    autoplay: {
      delay: 2000,
      disableOnInteraction: false,
    },
    coverflowEffect: {
      rotate: 30,
      stretch: 0,
      depth: 100,
      modifier: 1,
      slideShadows: true,
    }
  });

  $('.swiper-slide img').on('click', function() {
    const src = $(this).attr('src');
    const nama = $(this).data('nama');
    const deskripsi = $(this).data('deskripsi');

    $('#zoomedImage').attr('src', src);
    $('#productName').text(nama);
    $('#productDesc').text(deskripsi);
    $('#zoomModal').modal('show');
  });
</script>
