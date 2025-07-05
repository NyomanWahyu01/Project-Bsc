<?php
session_start();
error_reporting(0);
if ($_SESSION['home'] != "") {
  header('Location: pendaftaran.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Badminton Smapul Club - Ekstrakulikuler Bulutangkis SMA Negeri 10 Makassar">
  <meta name="author" content="Badminton Smapul Club">
  <meta name="keywords" content="badminton, smapul, makassar, ekstrakulikuler, sma 10">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <title>Badminton Smapul Club</title>
  <link rel="icon" href="/assets/images/logo-bsc.ico" type="image/x-icon" />


  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-onix-digital.css">
  <link rel="stylesheet" href="assets/css/animated.css">
  <link rel="stylesheet" href="assets/css/owl.css">

  <!--
  

TemplateMo 565 Onix Digital

https://templatemo.com/tm-565-onix-digital

-->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <style>
    /* Card Our Coaches sama tinggi dan prestasi rata bawah */
    .swiper-wrapper {
      display: flex;
      align-items: stretch;
    }
    .swiper-slide {
      display: flex;
      height: auto;
    }
    .coach-card {
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      width: 100%;
    }
    .coach-achievements {
      margin-top: auto;
    }
  </style>
</head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav top-10 start-50 d-flex align-items-center justify-content-between">

            <!-- ***** Logo Start ***** -->
            <a href="index.php" class="logo d-flex align-items-center" style="margin-top: 0;">
              <img src="assets/images/logo2.png" style="max-height: 35px; width: auto;" alt="BSC Logo">
            </a>
            <!-- ***** Logo End ***** -->

            <!-- ***** Menu Start ***** -->
            <ul class="nav" style="margin-bottom: 0;">
              <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
              <li class="scroll-to-section"><a href="#about">About</a></li>
              <li class="scroll-to-section"><a href="#pengurus">Pengurus</a></li>
              <li class="scroll-to-section"><a href="#coach">Coach</a></li>
              <li class="scroll-to-section"><a href="#team">Team</a></li>
              <li class="scroll-to-section">
                <div class="main-red-button-hover"><a href="#contact">Contact Us Now</a></div>
              </li>
            </ul>
            <a class='menu-trigger'>
              <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <div class="main-banner" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-6 align-self-center">
              <div class="owl-carousel owl-banner">
                <div class="item header-text">
                  <h3 class="text-4xl font-bold mb-6 leading-tight animate__animated animate__fadeInLeft">
                    <em class="text-blue-600">Welcome To <br> Badminton Smapul Club</em>
                    <br> Ekstrakurikuler SMA NEGERI 10 MAKASSAR
                  </h3>
                  <p class="warna-teks text-lg leading-relaxed mb-8 max-w-2xl animate__animated animate__fadeInUp">
                    Bagi Siswa/Siswi SMA Negeri 10 Makassar yang ingin bergabung dengan ekstrakulikuler Badminton Smapul Club, silakan klik tombol di bawah ini!
                  </p>
                  <div class="down-buttons animate__animated animate__fadeInUp">
                    <div class="main-blue-button-hover">
                      <a href="pendaftaran.php"
                        class="inline-block px-8 py-3 text-white font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 hover:bg-blue-700"
                        target="_blank"
                        rel="noopener noreferrer">
                        DAFTAR SEKARANG!
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="about" class="about-us section bg-gray-50">
    <div class="container">
      <!-- Layer 1: Sejarah -->
      <div class="row mb-5">
        <div class="col-lg-10 offset-lg-1">
          <div class="section-heading text-center">
            <h2 class="animate__animated animate__fadeInUp">Sejarah <em>Badminton</em> <span>Smapul Club</span></h2>
            <div class="line-dec mx-auto mb-4"></div>
            <div class="history-content text-justify">
              <p class="lead mb-4 animate__animated animate__fadeInUp" data-wow-delay="0.2s">
                Badminton Smapul Club (BSC) didirikan pada tahun 2016 sebagai wadah pengembangan bakat bulutangkis siswa/siswi SMA Negeri 10 Makassar.
              </p>
              <p class="mb-3 animate__animated animate__fadeInUp" data-wow-delay="0.4s">
                Berawal dari sekelompok siswa yang memiliki passion dalam olahraga bulutangkis, BSC terbentuk dengan dukungan penuh dari pihak sekolah. Dibawah bimbingan guru olahraga dan pelatih yang berpengalaman, BSC terus berkembang menjadi salah satu ekstrakulikuler unggulan di SMA Negeri 10 Makassar.
              </p>
              <p class="mb-3 animate__animated animate__fadeInUp" data-wow-delay="0.6s">
                Sejak berdiri, BSC telah melahirkan banyak atlet berbakat dan meraih berbagai prestasi di tingkat kota hingga provinsi. Dengan semangat "Together We Are Strong", BSC terus berkomitmen mengembangkan bakat dan karakter siswa melalui olahraga bulutangkis.
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Layer 2: Data Anggota -->
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <div class="section-heading text-center">
            <h2 class="animate__animated animate__fadeInUp">Data Anggota <em>Ekstrakulikuler</em> <span>Badminton Smapul Club</span></h2>
            <div class="line-dec mx-auto mb-4"></div>
            <p class="mb-5 animate__animated animate__fadeInUp">Data ini merupakan hasil rekapan semua anggota dalam Ekstrakulikuler Badminton Smapul Club setiap Angkatan</p>

            <?php
            require_once 'koneksi.php';
            $total_anggota = getTotalAnggota();  // Akan hitung status = 'Anggota'
            $total_alumni = getTotalAlumni();    // Akan hitung status = 'Senior'
            ?>

            <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="fact-item animate__animated animate__fadeInRight">
                  <div class="count-area-content hover:shadow-lg transition-all duration-300">
                    <div class="icon">
                      <img src="assets/images/service-icon-03.png" alt="">
                    </div>
                    <div class="count-digit counter"><?php echo $total_anggota; ?></div>
                    <div class="count-title">Anggota BSC</div>
                    <p>Total Anggota Badminton Smapul Club.</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="fact-item animate__animated animate__fadeInLeft">
                  <div class="count-area-content hover:shadow-lg transition-all duration-300">
                    <div class="icon">
                      <img src="assets/images/service-icon-02.png" alt="">
                    </div>
                    <div class="count-digit counter"><?php echo $total_alumni; ?></div>
                    <div class="count-title">Alumni BSC</div>
                    <p>Total Alumni Badminton Smapul Club.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
      if (isset($_POST['tambah_anggota'])) {
        $nama = clean_input($_POST['nama']);
        $kelas = clean_input($_POST['kelas']);
        $deskripsi = clean_input($_POST['deskripsi']);
        $status = clean_input($_POST['status']);

        $query = mysqli_query($conn, "INSERT INTO anggota_bsc (nama, kelas, deskripsi, status) 
                                       VALUES ('$nama', '$kelas', '$deskripsi', '$status')");
        if ($query) {
          $success_anggota = "Anggota berhasil ditambahkan!";
        } else {
          $error_anggota = "Gagal menambahkan anggota: " . mysqli_error($conn);
        }
      }

      ?>

    </div>
  </div>

  <!-- PENGURUS -->
  <div id="pengurus" class="our-portfolio section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading text-center">
            <h2>Pengurus <em>Badminton</em> <span>Smapul Club</span></h2>
            <p class="mt-3">Pengurus yang bertanggung jawab dalam mengelola dan mengembangkan BSC</p>
          </div>
        </div>
      </div>

      <div class="row mt-5">
        <?php
        require_once 'koneksi.php';
        $query = mysqli_query($conn, "SELECT * FROM pengurus_bsc ORDER BY FIELD(jabatan, 'Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Sesi Perlengkapan', 'Sesi Kepelatihan', 'Sesi Konsumsi', 'Sesi Keamanan')");
        while ($row = mysqli_fetch_assoc($query)) {
          // Menentukan ukuran kolom berdasarkan jabatan
          $colSize = in_array($row['jabatan'], ['Ketua', 'Wakil Ketua']) ? 'col-lg-6' : 'col-lg-4';
        ?>
          <div class="<?php echo $colSize; ?> col-md-6 mb-4">
            <div class="team-member text-center p-6 rounded-xl bg-gradient-to-b from-gray-50 to-gray-100 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2">
              <img src="assets/img/pengurus/<?php echo htmlspecialchars($row['foto']); ?>"
                alt="<?php echo htmlspecialchars($row['nama']); ?>"
                class="rounded-full w-48 h-48 mx-auto mb-4 object-cover shadow-md">
              <h4 class="font-bold text-xl mb-2"><?php echo htmlspecialchars($row['nama']); ?></h4>
              <p class="text-gray-600 mb-3"><?php echo htmlspecialchars($row['jabatan']); ?></p>
              <p class="text-sm text-gray-500">Kelas <?php echo htmlspecialchars($row['kelas']); ?></p>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <!-- END PENGURUS -->

  <!-- COACH -->
  <div id="coach" class="our-portfolio section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading text-center">
            <h2>Our <em>Coaches</em></h2>
            <p class="mt-3">Tim pelatih yang berdedikasi untuk mengembangkan bakat bulutangkis di SMA Negeri 10 Makassar</p>
          </div>
        </div>
      </div>
      <!-- Dynamic Coach Cards as Swiper Slider -->
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <?php
          require_once 'koneksi.php';
          $query = mysqli_query($conn, "SELECT * FROM coach_bsc ORDER BY jabatan ASC");
          while ($row = mysqli_fetch_assoc($query)) {
            $cardClass = $row['jabatan'] == 'Senior Coach' ? 'from-blue-50 to-blue-100' : 'from-green-50 to-green-100';
            $borderClass = $row['jabatan'] == 'Senior Coach' ? 'border-blue-400' : 'border-green-400';
            $badgeClass = $row['jabatan'] == 'Senior Coach' ? 'bg-blue-500' : 'bg-green-500';
          ?>
            <div class="col-lg-5 col-md-6 mb-4 swiper-slide">
              <div class="coach-card text-center p-8 rounded-2xl bg-gradient-to-b <?php echo $cardClass; ?> hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <div class="relative mb-6">
                  <img src="assets/img/coach/<?php echo htmlspecialchars($row['foto']); ?>"
                    alt="<?php echo htmlspecialchars($row['nama']); ?>"
                    class="rounded-full w-56 h-56 mx-auto object-cover border-4 <?php echo $borderClass; ?>">
                  <div class="absolute -bottom-3 left-1/2 transform -translate-x-1/2 <?php echo $badgeClass; ?> text-white px-6 py-2 rounded-full">
                    <?php echo htmlspecialchars($row['jabatan']); ?>
                  </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($row['nama']); ?></h3>
                <p class="text-<?php echo $row['jabatan'] == 'Senior Coach' ? 'blue' : 'green'; ?>-600 font-medium mb-4"><?php echo htmlspecialchars($row['status']); ?></p>
                <p class="text-gray-600 mb-6">
                  "<?php echo $row['motto']; ?>"
                </p>
                <div class="coach-achievements text-left bg-white p-4 rounded-lg shadow-sm">
                  <h4 class="font-semibold text-gray-700 mb-2">Prestasi:</h4>
                  <div class="text-gray-600">
                    <?php echo nl2br(htmlspecialchars($row['prestasi'])); ?>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <!-- Navigasi panah -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <!-- Pagination bulat -->
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </div>
  <!-- END COACH -->

  <!-- TEAM -->
  <div id="team" class="our-portfolio section">
    <div class="portfolio-left-dec">
      <img src="assets/images/portfolio-left-dec.png" alt="">
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div class="section-heading">
            <h2 class="text-center whitespace-normal">
              Kejuaraan Turnamen Antar Sekolah Yang Sudah Diikuti Oleh
              <em>Badminton</em> <span>Smapul Club</span>
            </h2>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="owl-carousel owl-portfolio">
            <?php
            require_once 'koneksi.php';
            $query = mysqli_query($conn, "SELECT * FROM juara_bsc ORDER BY tahun DESC, peringkat ASC");
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
              <div class="item">
                <div class="thumb">
                  <img src="assets/img/juara/<?php echo htmlspecialchars($row['foto']); ?>" alt="Foto Juara" style="width: 100%; height: 300px; object-fit: cover;">
                  <div class="hover-effect">
                    <div class="inner-content">
                      <h4>Juara <?php echo htmlspecialchars($row['peringkat']); ?> 🏆</h4>
                      <span><?php echo htmlspecialchars($row['kejuaraan']); ?></span>
                      <p class="mt-2">Tingkat: <?php echo htmlspecialchars($row['tingkat']); ?> (<?php echo htmlspecialchars($row['tahun']); ?>)</p>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END TEAM -->

  <!-- Contact -->
  <div id="contact" class="contact-us section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading text-center">
            <h2>Contact Us <em>Badminton</em> <span>Smapul Club</span></h2>
          </div>
        </div>

        <div class="col-lg-8">
          <!-- Google Maps -->
          <div id="map" class="mb-5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.4880962721636!2d119.4857261735395!3d-5.185676052318175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee397e9d63051%3A0x58456f69c8f14216!2sSMA%20Negeri%2010%20Makassar!5e0!3m2!1sid!2sid!4v1736171049827!5m2!1sid!2sid"
              style="border:0; width:155%; height:300px;" " allowfullscreen="" loading=" lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>

        <!-- Contact Buttons -->
        <div class="col-lg-12">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <div class="info-item text-center p-6 rounded-xl bg-gradient-to-r from-green-100 to-green-200 hover:from-green-200 hover:to-green-300 transition-all duration-300 transform hover:scale-105">
                <i class="fa fa-phone mb-2 text-3xl text-green-600"></i>
                <h5 class="font-bold text-green-800 mb-3">WhatsApp</h5>
                <a href="http://api.whatsapp.com/send?phone=6281524914330&text=<?php
                                                                                $pesan = "Assalamualaikum Wr. Wb."
                                                                                  . "Saya ingin bertanya mengenai Badminton Smapul Club (BSC)."
                                                                                  . "Mohon informasi lebih lanjut."
                                                                                  . "Terima kasih.";
                                                                                echo urlencode($pesan);
                                                                                ?>"
                  target="_blank" class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-sm leading-tight rounded-lg shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">
                  Contact Via WhatsApp
                </a>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <div class="info-item text-center p-6 rounded-xl bg-gradient-to-r from-purple-100 to-pink-200 hover:from-purple-200 hover:to-pink-300 transition-all duration-300 transform hover:scale-105">
                <i class="fa fa-instagram mb-2 text-3xl text-pink-600"></i>
                <h5 class="font-bold text-purple-800 mb-3">Instagram</h5>
                <a href="https://www.instagram.com/bscsmapul10/"
                  target="_blank" class="inline-block px-6 py-2.5 bg-gradient-to-r from-purple-500 via-pink-500 to-orange-500 text-white font-medium text-sm leading-tight rounded-lg shadow-md hover:opacity-90 hover:shadow-lg focus:opacity-90 focus:shadow-lg focus:outline-none focus:ring-0 active:opacity-80 active:shadow-lg transition duration-150 ease-in-out">
                  Follow Us
                </a>
              </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
              <div class="info-item text-center p-6 rounded-xl bg-gradient-to-r from-blue-100 to-blue-200 hover:from-blue-200 hover:to-blue-300 transition-all duration-300 transform hover:scale-105">
                <i class="fa fa-envelope mb-2 text-3xl text-blue-600"></i>
                <h5 class="font-bold text-blue-800 mb-3">Email</h5>
                <a href="mailto:bscsmapuljaya@gmail.com"
                  target="_blank" class="inline-block px-6 py-2.5 bg-blue-500 text-white font-medium text-sm leading-tight rounded-lg shadow-md hover:bg-blue-600 hover:shadow-lg focus:bg-blue-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-700 active:shadow-lg transition duration-150 ease-in-out">
                  Send Email
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Copyright
        <div class="col-lg-12 mt-5">
          <div class="copyright text-center">
            <p>&copy; 2024 Badminton Smapul Club. All Rights Reserved.</p>
          </div>
        </div> -->

        <!-- Footer -->
        <footer>
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="copyright text-center">
                  <h5 class="text-bold">&copy; 2025 Badminton Smapul Club. All Rights Reserved.</h5>
                  <!-- <a href="https://www.instagram.com/inyoman_wahyu1/" target="_blank" class="copyright text-center">Devoleper Website</a> -->
                </div>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <!-- Scripts -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/animation.js"></script>
  <script src="assets/js/imagesloaded.js"></script>
  <script src="assets/js/custom.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Preloader dengan timeout
      setTimeout(function() {
        document.querySelector('.js-preloader').classList.add('loaded');
      }, 1000);

      // Debounce untuk sticky header
      let scrollTimeout;
      window.addEventListener('scroll', function() {
        if (scrollTimeout) {
          clearTimeout(scrollTimeout);
        }
        scrollTimeout = setTimeout(function() {
          const header = document.querySelector('.header-area');
          if (window.scrollY > 100) {
            header.classList.add('header-sticky');
          } else {
            header.classList.remove('header-sticky');
          }
        }, 50);
      });

      // Form Validation yang lebih baik
      window.validateForm = function() {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();

        if (!name || !email || !message) {
          alert('Mohon lengkapi semua field!');
          return false;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
          alert('Mohon masukkan email yang valid!');
          return false;
        }

        if (message.length < 10) {
          alert('Pesan minimal 10 karakter!');
          return false;
        }

        return true;
      };
    });
  </script>
  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        768: { slidesPerView: 2 },
        1200: { slidesPerView: 3 }
      }
    });
  </script>
</body>

</html>