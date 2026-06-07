<footer class="footer_section">
  <div class="container">
    <div class="row">
      <div class="col-md-4 footer-col">
        <div class="footer_contact">
          <h4>Contact Us</h4>
          <div class="contact_link_box">
            <a href="https://maps.app.goo.gl/EcRNq5XPYipyinaX6">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <span>Location</span>
            </a>
            <a>
              <i class="fa fa-phone" aria-hidden="true"></i>
              <span>Call +62 895-1954-2595</span>
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-4 footer-col">
        <div class="footer_detail">
          <a href="#" class="footer-logo" id="loginLink">
            Shradda Coffee
          </a>
          <p>
            Sraddha Coffee adalah kedai kopi lokal yang menghadirkan nuansa hangat dan nyaman di tengah hiruk-pikuk kota Bekasi. Dengan racikan kopi spesialti yang dipilih secara selektif, kami menyajikan cita rasa terbaik bagi para penikmat kopi sejati.          </p>
        </div>
      </div>

      <div class="col-md-4 footer-col">
        <h4>Opening Hours</h4>
        <p>Senin - Kamis : 14.00-22.00 WIB</p>
        <p>Jum'at        : 15.00-23.00 WIB</p>
        <p>Sabtu - Minggu : 08.00-23.30 WIB</p>
      </div>
    </div>
    <div class="footer-info"></div>
  </div>
</footer>

<script>
  let clickCount = 0;
  document.getElementById('loginLink').addEventListener('click', function (e) {
    e.preventDefault();
    clickCount++;
    if (clickCount >= 5) {
      window.location.href = "<?= site_url('admin/serada_cru/login') ?>";
    }
  });
</script>
