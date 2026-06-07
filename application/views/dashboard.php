<body>
  <div class="hero_area">
    <div class="bg-box">
      <!-- Carousel untuk Gambar Background -->
      <div id="backgroundCarousel" class="carousel slide" data-ride="carousel" data-interval="2000">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="<?php echo base_url('assets/images/1/b.jpg'); ?>" class="d-block w-100" alt="Kopi">            
          </div>
          <div class="carousel-item">
            <img src="<?php echo base_url('assets/images/1/e.jpg'); ?>" class="d-block w-100" alt="Kopi 2">          
          </div>
          <div class="carousel-item">
            <img src="<?php echo base_url('assets/images/1/j.jpg'); ?>" class="d-block w-100" alt="Kopi 3">           
          </div> 
        </div>
      </div>
    </div>

    <section class="slider_section">
      <div class="container">
        <div class="row">
          <div class="col-md-9 col-lg-100">
            <div class="detail-box">
              <h1>
                Sraddha Coffee
              </h1>
              <p>
              <p class="deskripsi-cafe">
              Sraddha Coffee adalah kedai kopi lokal yang menghadirkan nuansa hangat dan nyaman di tengah hiruk-pikuk kota Bekasi. Dengan racikan kopi spesialti yang dipilih secara selektif, kami menyajikan cita rasa terbaik bagi para penikmat kopi sejati.
              Mengusung konsep klasik, estetik, dan homey, Sraddha Coffee menjadi tempat favorit bagi pecinta kopi, pekerja remote, komunitas, hingga para pencari inspirasi. Lebih dari sekadar tempat menikmati kopi, kami adalah ruang untuk berbagi cerita, ide, dan kebersamaan.
              Selain kopi berkualitas, kami juga menawarkan beragam pilihan menu makanan dan minuman yang cocok dinikmati dalam berbagai suasana, lengkap dengan pelayanan ramah yang membuat setiap kunjungan terasa istimewa.
              </p>
              </div>
          </div>
        </div>
      </div>
    </section>
  </div>


  <!-- food section -->
  <section class="food_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Menu
        </h2>
      </div>

<div class="filters-content">
  <div class="row justify-content-center">
    <div class="col-sm-8 col-md-6 col-lg-4 all pizza">
      <div class="box text-center">
        <div class="img-box">
          <img src="<?php echo base_url('assets/images/Menu1.jpg')?>" alt="" class="img-fluid mx-auto d-block" style="max-width: 100%; height: auto; cursor: pointer;" data-toggle="modal" data-target="#zoomModal" data-img="<?php echo base_url('assets/images/Menu1.jpg')?>">
        </div>
      </div>
    </div>

    <div class="col-sm-8 col-md-6 col-lg-4 all pizza">
      <div class="box text-center">
        <div class="img-box">
          <img src="<?php echo base_url('assets/images/Menu2.jpg')?>" alt="" class="img-fluid mx-auto d-block" style="max-width: 100%; height: auto; cursor: pointer;" data-toggle="modal" data-target="#zoomModal" data-img="<?php echo base_url('assets/images/Menu2.jpg')?>">
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Zoom Gambar -->
<div class="modal fade" id="zoomModal" tabindex="-1" role="dialog" aria-labelledby="zoomModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content" style="background: transparent; border: none;">
      <div class="modal-body text-center">
        <img id="zoomedImage" src="" class="img-fluid rounded" style="max-height: 80vh;">
      </div>
    </div>
  </div>
</div>

<!-- Script Zoom Gambar -->
<script>
  // Ambil semua gambar dengan data-toggle modal
  const images = document.querySelectorAll('[data-toggle="modal"]');

  images.forEach(img => {
    img.addEventListener('click', function() {
      const imgSrc = this.getAttribute('data-img');
      document.getElementById('zoomedImage').setAttribute('src', imgSrc);
    });
  });
</script>

      <div class="btn-box">
        <a href="dashboard/menu">
          View More
        </a>
      </div>
    </div>
  </section>
  <!-- end food section -->

  <!-- about section -->
  <section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="<?php echo base_url('assets/images/a.png')?>" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                SRADDHA COFFE
              </h2>
            </div>
            <p>
            SRADDHA COFFEE adalah kafe bertema otomotif yang menyajikan kopi berkualitas dalam suasana industrial. Lebih dari sekadar tempat ngopi, SRADDHA hadir sebagai ruang berkumpul komunitas dengan semangat dan filosofi yang kuat.            </p>
            <a href="<?php echo base_url('dashboard/about') ?>">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end about section -->

  <!-- book section -->
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet"> 
  <section class="book_section layout_padding">
  <div class="container">
    <div class="heading_container">
      <h2>
        Book A Table
      </h2>
    </div>
    <div class="row align-items-center">
      <!-- Kolom Kiri: Instruksi Booking -->
      <div class="col-md-6">
        <div class="detail-box">
          <h3>Reservasi Mudah</h3>
          <p>
            Untuk memesan meja, silakan hubungi kami dengan cara klik tombol di bawah ini.<br>
            Kami akan segera mengonfirmasi ketersediaan meja untuk Anda.
          </p>
          <div class="btn_box">
            <button>
              <a href="<?php echo base_url('dashboard/booking'); ?>" style="color: white; text-decoration: none;">
                Book Now
              </a>
            </button>
          </div>
        </div>
      </div>

      <!-- Kolom Kanan: Gambar -->
      <div class="col-md-6">
        <div class="img-box">
          <img src="<?php echo base_url('assets/images/QR1.png'); ?>" alt="Booking Image" class="img-fluid" style="max-width: 100%; border-radius: 10px;">
        </div>
      </div>
    </div>
  </div>
</section>
 
<style>
    .btn_box button {
    background-color: #ff6f61;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 5px;
    text-transform: uppercase;
    font-weight: bold;
    margin-top: 20px;
  }

  .deskripsi-cafe {
  line-height: 1.7;         
  padding: 20px;             
  }
 </style>