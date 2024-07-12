<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'mahasiswa') {
  header("Location: login.php");
  exit;
}
$username = $_SESSION['username'];
$query = "select npm from users where username='$username'";
$result = mysqli_query($koneksi, $query);
while ($row = mysqli_fetch_array($result)) {
  $npmm = $row['npm'];
  if (isset($_POST['submit'])) {
    $npm = $_POST['npm'];
    $isi = $_POST['isi'];
    $fileName = $_FILES['gambar']['name'];
    $fileSize = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    // Validasi dan proses upload gambar
    if ($error == 4) {
      echo "<script> alert('Masukkan Gambar')</script>";
    } elseif (!in_array(strtolower(pathinfo($fileName, PATHINFO_EXTENSION)), ['jpg', 'png', 'jpeg'])) {
      echo "<script> alert('Yang Anda upload bukan gambar')</script>";
    } elseif ($fileSize > 10000000) {
      echo "<script> alert('Gambar terlalu besar')</script>";
    } else {
      $fileName = uniqid() . '.' . strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
      move_uploaded_file($tmpName, 'images/' . $fileName);

      // Insert ke database
      $query = "INSERT INTO prosespengaduan (npm, idadmin, isiaduan, tanggal, statuspengaduan, foto) 
                  VALUES ('$npm', '121', '$isi', NOW(), 'Berhasil terkirim', '$fileName')";
      $result = mysqli_query($koneksi, $query);
      if ($result) {
        echo "<script> alert('Berhasil');
             window.location.href = 'landingpage.php#proses;
             </script>";
      }
    }
  }

  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Layanan Pengaduan Mahasiswa UMI</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="gambar/umi.png" rel="icon">

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

  </head>

  <body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center header-transparent">
      <div class="container d-flex align-items-center justify-content-between">

        <div class="logo">
          <h1><a href="landingpage.php"><img src="gambar/umi.png" alt="" class="img-fluid">
              <span>Layanan Pengaduan Mahasiswa</span></a></h1>
        </div>

        <nav id="navbar" class="navbar">
          <ul>
            <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
            <li><a class="nav-link scrollto" href="#about">About</a></li>
            <li><a class="nav-link scrollto" href="#formpengaduan">Form Pengaduan</a></li>
            <li><a class="nav-link scrollto" href="#panduan">Panduan</a></li>
            <li class="dropdown"><a href="#"><span><?php echo $username; ?></span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="#termservice">Term And Service</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

      </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">

      <div class="container">
        <div class="row justify-content-between">
          <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
            <div data-aos="zoom-out">
              <h1>Selamat Datang Di <span>Website Pengaduan Mahasiswa</span></h1>
              <h2>Website ini dibuat untuk memberitahu masalah fasilitas
                ataupun dosen di Universitas Methodist Indonesia</h2>
              <div class="text-center text-lg-start">
                <a href="#about" class="btn-get-started scrollto">Get Started</a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
            <img src="gambar/pengaduan-online.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

      <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
          <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
        </defs>
        <g class="wave1">
          <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
        </g>
        <g class="wave2">
          <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
        </g>
        <g class="wave3">
          <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
        </g>
      </svg>

    </section><!-- End Hero -->

    <main id="main">

      <!-- ======= About Section ======= -->
      <section id="about" class="about">
        <div class="container">
          <div class="section-title" data-aos="fade-up" data-aos-delay="100">
            <h2>ABOUT</h2>
            <p>Tentang Layanan Pengaduan Mahasiswa</p>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <img src="gambar/about.png" class="img-fluid" data-aos="fade-right" data-aos-delay="200">
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="300">
                  <h5>Selamat Datang di Layanan Pengaduan Mahasiswa</h5>
                  <p>Layanan Pengaduan Mahasiswa adalah platform yang dirancang untuk memberikan kemudahan bagi mahasiswa
                    dalam menyampaikan keluhan, saran, dan masukan terkait berbagai aspek kehidupan kampus. Kami
                    berkomitmen untuk menciptakan lingkungan kampus yang lebih baik melalui penanganan yang cepat dan
                    tepat terhadap setiap pengaduan yang diterima.</p>
                  <p>Fitur-fitur utama layanan kami:</p>
                  <ul>
                    <li>Pengaduan Anonim: Anda dapat mengirimkan pengaduan secara anonim untuk menjaga privasi Anda.</li>
                    <li>Respon Cepat: Tim kami akan merespon setiap pengaduan dalam waktu 24 jam.</li>
                    <li>Statistik Pengaduan: Lihat statistik dan status pengaduan Anda secara real-time.</li>
                  </ul>
                  <p>Terima kasih telah mempercayakan pengaduan Anda kepada kami. Bersama-sama, mari kita ciptakan
                    lingkungan kampus yang lebih baik dan harmonis.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section><!-- End About Section -->

      <!-- ======= Form Pengaduan Section ======= -->
      <section id="formpengaduan">
        <div class="container">

          <div class="section-title" data-aos="fade-up" data-aos-delay="100">
            <h2>FORM</h2>
            <p>Layanan Pengaduan</p>
          </div>

          <div class="row" data-aos="fade-left" data-aos-delay="200">

            <form method="POST" enctype="multipart/form-data">
              <div class="container-fluid" id="pengaduan">
                <div class="row">
                  <div class="col-md-8 py-5 ">
                    <div class="mb-3">
                      <label class="form-label">Input NPM</label>
                      <br>
                      <input name="npm" for="disabledSelect" class="form-control" value="<?php echo $npmm ?>" readonly>
                      <div class="form-text">pastikan npm sudah sesuai.</div>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Isi Pengaduan</label>
                      <textarea id="disabledTextInput" class="form-control" name="isi" width="300"></textarea>
                    </div>
                    <div class="mb-3">
                      <div class="form-group">
                        <table>
                          <tr>
                            <td style="width:20rem;"><label for="fileInput">File pendukung</label></td>
                            <td><input type="file" class="form-control-file" id="gambar" name="gambar">
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div>
                      <p class="fs-6 fw-lighter fst-italic" style="color:red;">Note : Anda bisa membatalkan data pengaduan
                        sebelum data tersebut diproses</p>
                    </div>
                    <br>
                    <center><button type="submit" class="btn btn-primary" name="submit">Submit</button></center>
                  </div>

            </form>
            <div class="col-md-4 py-5">
              <div class="card" style="width: 25rem; height:30rem;">
                <div class="card-body d-flex flex-column" style="height: 100%;">
                  <div class="nav nav-pills nav-stacked flex-grow-1" style="overflow-y: auto;">
                    <h6 class="card-subtitle mb-2 text-danger">Tata Cara Pengaduan</h6>
                    <p class="card-text">Pastikan telah membaca tata cara pengaduan pada laman panduan</p>

                    <li class="nav-item">
                      <p>1.Tentukan secara jelas masalah atau keluhan yang Anda alami. Catat semua detail
                        yang relevan seperti tanggal, waktu, tempat, dan pihak yang terlibat.</p>
                    </li>
                    <li class="nav-item">
                      <p>2.Kumpulkan bukti yang mendukung keluhan Anda, seperti email, pesan teks, foto,
                        atau dokumen lainnya yang relevan.</p>
                    </li>
                    <li class="nav-item">
                      <p>3.Pastikan Anda memiliki informasi kontak yang benar, seperti alamat email atau
                        nomor telepon dari pihak terkait.</p>
                    </li>
                    <li class="nav-item">
                      <p>4.Susun pengaduan Anda dalam format tertulis dengan jelas dan terstruktur.</p>
                    </li>
                    <li class="nav-item">
                      <p>5.Kirimkan pengaduan tertulis Anda melalui jalur yang telah ditentukan.</p>
                    </li>
                    <li class="nav-item">
                      <p>7.Susun pengaduan Anda dalam format tertulis dengan jelas dan terstruktur.
                        Mulailah dengan pengenalan diri, lalu deskripsikan masalah, berikan bukti
                        pendukung, dan akhiri dengan permintaan atau harapan Anda terkait penyelesaian
                        masalah..</p>
                    </li>
                    <li class="nav-item">
                      <p>8.Kumpulkan bukti yang mendukung keluhan Anda, seperti email, pesan teks, foto,
                        atau dokumen lainnya yang relevan.</p>
                    </li>
                    <li class="nav-item">
                      <p>9.Gunakan bahasa yang sopan dan profesional. Hindari penggunaan bahasa yang
                        emosional atau ofensif serta mengandung kalimat SARA.</p>
                    </li>
                    <a href="#" class="card-link mt-2">Pelajari selengkapnya..</a>
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
      </section><!-- End Pengaduan Section -->
      <div class="modal-dialog modal-dialog-scrollable">
        ...
      </div>

      <?php

      ?>
      <section id="proses">
        <div class="container">

          <div class="section-title" data-aos="fade-up" data-aos-delay="100">
            <h2>FORM</h2>
            <p>History Pengaduan</p>
          </div>

          <table border="1" class="table table-striped">
            <tr>
              <form action="landingpage.php?#proses" method="GET">
                <td></td>
                <td><input class="form-control" type="search" placeholder="Search" aria-label="Search" name="cari"></td>
                <td><input type="submit" class="btn btn-outline-success" value="cari">
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><button type="submit" class="btn btn-outline-primary " style="width:60px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2z" />
                      <path
                        d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466" />
                    </svg></td>

              </form>
            </tr>


            <tr>
              <th>NO</th>
              <th>Id LAPORAN</th>
              <th>NPM</th>
              <th>NAMA</th>
              <th>PROGRAM STUDI</th>
              <th>ISI ADUAN</th>
              <th>TANGGAL PENGADUAN</th>
              <th>STATUS PENGADUAN</th>
              <th>FOTO</th>
            </tr>
            <?php
            if (isset($_GET['cari'])) {
              $cari = $_GET['cari'];
              $query = "SELECT DISTINCT idlaporan, prosespengaduan.npm, nama, program_studi, isiaduan, tanggal, statuspengaduan, foto
FROM prosespengaduan
INNER JOIN users ON prosespengaduan.npm = users.npm
WHERE (idlaporan LIKE '%$cari%' OR isiaduan LIKE '%$cari%')
AND prosespengaduan.npm = $npmm;";
              $result = mysqli_query($koneksi, $query);
            } else {
              $query = "SELECT idlaporan,prosespengaduan.npm,nama,program_studi,isiaduan,tanggal,statuspengaduan,foto FROM prosespengaduan INNER JOIN users where prosespengaduan.npm = users.npm and prosespengaduan.npm=$npmm ";
              $result = mysqli_query($koneksi, $query);
            }
            $i = 0;
            while ($row = mysqli_fetch_array($result)) {
              $status = $row['statuspengaduan'];
              $tgl = date_create($row['tanggal']);
              $formatted_date = date_format($tgl, 'd-m-Y');
              $i++;
              ?>
              <tr>
                <td style=""><?php echo $i ?></td>
                <td><?php echo $row['idlaporan'] ?></td>
                <td><?php echo $row['npm'] ?></td>
                <td><?php echo $row['nama'] ?></td>
                <td><?php echo $row['program_studi'] ?></td>
                <td><?php echo $row['isiaduan'] ?></td>
                <td><?php echo $formatted_date ?></td>
                <td><?php echo $row['statuspengaduan'] ?></td>
                <td><img src="images/<?php echo $row['foto']; ?>" width="160" height="100" </td>
                <td style="width: 150px;">

                  <!-- <?php //if ($status == "Diproses") { ?>
                    <button type="button" class="btn  btn-sm btn-warning disabled">
                      Edit
                    </button><?php //} elseif ($status == "Berhasil terkirim") { ?><form action="self.php?idlaporan=<?= $row['idlaporan']?>" method="post"><button class="btn btn-sm btn-warning"
                      data-bs-toggle="modal" type="submit">Edit</button></form>
                      <?php 
                      // if(isset($_GET['buttonEdit'])){
                      //   $id=$_POST['idlaporan'];
                      // }
                        ?> -->
                     
                   <?php
                 
                //  require 'self.php'; ?>
                      
                  <?php if ($status == "Diproses") { ?> <a href="hapus.php?id=<?php echo $row['idlaporan'] ?>"
                      class="btn btn-sm btn-secondary disabled">Hapus</a><?php } elseif ($status == "Berhasil terkirim") { ?><a
                      href="hapus.php?idlaporan=<?php echo $row['idlaporan'] ?>"
                      class="btn btn-sm btn-danger ">Batal</a><?php } ?>
                </td>
              </tr>
            <?php }
} ?>
          <!-- Scrollable modal -->

        </table>
    </section>

    <!-- ======= Panduan Section ======= -->
    <section id="panduan">
      <div class="container">

        <div class="section-title" data-aos="fade-up" data-aos-delay="150">
          <h2>Guide</h2>
          <p>Panduan Website</p>
        </div>
        <div class="row g-0" data-aos="fade-left" data-aos-delay="250">
          <div class="row content">
            <div class="col-md-4 order-1 order-md-2" data-aos="fade-left" data-aos-delay="300">
              <img src="assets/img/details-2.png" class="img-fluid" alt="">
            </div>
            <div class="col-md-8 pt-3 order-2 order-md-1" data-aos="fade-up" data-aos-delay="400">
              <h3 align="center">Panduan Untuk Pengaduan</h3>
              <p>1.Tentukan secara jelas masalah atau keluhan yang Anda alami. Catat semua detail yang relevan seperti
                tanggal, waktu, tempat, dan pihak yang terlibat.</p>
              <p>2.Kumpulkan bukti yang mendukung keluhan Anda, seperti email, pesan teks, foto, atau dokumen lainnya
                yang relevan.</p>
              <p>3.Pastikan Anda memiliki informasi kontak yang benar, seperti alamat email atau nomor telepon dari
                pihak terkait.</p>
              <p>4.Susun pengaduan Anda dalam format tertulis dengan jelas dan terstruktur.</p>
              <p>5.Kirimkan pengaduan tertulis Anda melalui jalur yang telah ditentukan.</p>
              <p>7.Susun pengaduan Anda dalam format tertulis dengan jelas dan terstruktur. Mulailah dengan pengenalan
                diri, lalu deskripsikan masalah, berikan bukti pendukung, dan akhiri dengan permintaan atau harapan Anda
                terkait penyelesaian masalah.</p>
              <p>8.Kumpulkan bukti yang mendukung keluhan Anda, seperti email, pesan teks, foto, atau dokumen lainnya
                yang relevan.</p>
              <p>9.Gunakan bahasa yang sopan dan profesional. Hindari penggunaan bahasa yang emosional atau ofensif
                serta mengandung kalimat SARA.</p>
            </div>
          </div>


        </div>

      </div>
    </section><!-- End panduan Section -->

    <!-- ======= Term dan Service Section ======= -->
    <section id="termservice" class="tds">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Policy</h2>
          <p>Term</p>
        </div>
        <div class="row" data-aos="fade-left">
          <p class="updated-date">Diperbarui terakhir: 19 Juni 2023</p>
          <div class="terms-content" data-aos-delay="300">
            <h3>1. Penerimaan Syarat</h3>
            <p>Dengan mengakses dan menggunakan layanan pengaduan ini, Anda setuju untuk mematuhi dan terikat oleh
              syarat dan ketentuan berikut. Jika Anda tidak setuju dengan syarat dan ketentuan ini, mohon untuk tidak
              menggunakan layanan ini.</p>
            <h3>2. Perubahan Syarat</h3>
            <p>Kami berhak untuk mengubah syarat dan ketentuan ini dari waktu ke waktu. Perubahan akan diberitahukan
              melalui situs web ini. Anda bertanggung jawab untuk meninjau syarat dan ketentuan ini secara berkala.</p>
            <h3>3. Penggunaan Layanan</h3>
            <p>Layanan ini hanya boleh digunakan untuk mengajukan pengaduan yang sah dan sesuai dengan hukum. Pengguna
              dilarang untuk:</p>
            <ul>
              <li>Menggunakan layanan ini untuk tujuan yang melanggar hukum.</li>
              <li>Mengirimkan informasi yang tidak benar, menyesatkan, atau palsu.</li>
              <li>Menggunakan layanan ini untuk menyebarkan materi yang melecehkan, menghina, atau diskriminatif.</li>
            </ul>
            <h3>4. Hak dan Kewajiban Pengguna</h3>
            <p>Pengguna berkewajiban untuk memberikan informasi yang akurat dan lengkap saat mengajukan pengaduan.
              Pengguna berhak untuk mendapatkan tindak lanjut yang adil dan transparan atas pengaduan yang
              diajukan.</p>
            <h3>5. Pembatasan Tanggung Jawab</h3>
            <p>Kami tidak bertanggung jawab atas kerugian langsung, tidak langsung, insidental, atau konsekuensial
              yang timbul dari penggunaan layanan ini. Kami berusaha untuk memberikan layanan yang terbaik,
              namun tidak dapat menjamin bahwa layanan ini akan bebas dari kesalahan atau gangguan.</p>
            <h3>6. Privasi</h3>
            <p>Penggunaan layanan ini juga tunduk pada kebijakan privasi kami yang dapat ditemukan di
              sevice.</p>
            <h3>7. Kontak</h3>
            <p>Jika Anda memiliki pertanyaan atau keluhan mengenai syarat dan ketentuan ini, silakan
              hubungi kami di +1 5589 55488 55.</p>
          </div>
        </div>
      </div>
    </section>

    <section id="service" class="srv">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <p>Service</p>
        </div>
        <div class="row" data-aos="fade-up">
          <div class="row" data-aos="fade-left">
            <div class="container">
              <h1 class="title">WHAT WE DO?</h1>
              <div class="services">
                <div class="service">
                  <div class="service-icon">
                    <img src="https://img.icons8.com/ios-filled/50/ffffff/customer-support.png" alt="1Icon">
                  </div>
                  <h2 class="service-title">Layanan Pengaduan Mahasiswa</h2>
                  <p class="service-description">Kami menyediakan platform untuk mahasiswa menyampaikan pengaduan
                    mengenai berbagai
                    isu akademik dan non-akademik. Layanan ini bertujuan untuk memastikan bahwa setiap suara
                    mahasiswa didengar dan ditangani dengan serius.</p>
                </div>
                <div class="service">
                  <div class="service-icon">
                    <img src="https://img.icons8.com/ios-filled/50/ffffff/settings.png" alt="2Icon">
                  </div>
                  <h2 class="service-title">Jenis Pengaduan yang Diterima</h2>
                  <ul class="service-description">
                    <li>Masalah akademik, seperti kesalahan penilaian, ketidakadilan dalam pengajaran, dll.</li>
                    <li>Masalah fasilitas kampus, seperti kebersihan, kerusakan peralatan, dll.</li>
                    <li>Masalah non-akademik, seperti bullying, diskriminasi, dll.</li>
                  </ul>
                </div>
                <div class="service">
                  <div class="service-icon">
                    <img src="https://img.icons8.com/ios-filled/50/ffffff/internet.png" alt="3Icon">
                  </div>
                  <h2 class="service-title">Cara Mengajukan Pengaduan</h2>
                  <ol class="service-description">
                    <li>Mengisi formulir pengaduan yang tersedia di website.</li>
                    <li>Menjelaskan masalah secara detail dan jelas.</li>
                    <li>Menyertakan bukti atau dokumentasi yang relevan (jika ada).</li>
                    <li>Mengirimkan pengaduan melalui platform yang telah disediakan.</li>
                  </ol>
                </div>
                <div class="service">
                  <div class="service-icon">
                    <img src="https://img.icons8.com/ios-filled/50/ffffff/service.png" alt="4Icon">
                  </div>
                  <h2 class="service-title">Proses Penanganan Pengaduan</h2>
                  <p class="service-description">Setelah pengaduan diajukan, tim kami akan meninjau dan
                    menindak lanjuti dalam waktu 7 hari kerja. Mahasiswa akan menerima konfirmasi melalui
                    lewat akun anda dan informasi lebih lanjut mengenai langkah-langkah selanjutnya.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section><!-- End Term dan Service Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Contact</h2>
          <p>Contact Us</p>
        </div>
        <div class="row" data-aos="fade-left">

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <a href="https://maps.app.goo.gl/y94PKMjFdQvavNMQ8" target="_blank" class="contact-icons">
              <div class="gif" data-aos="zoom-in" data-aos-delay="400">
                <div class="pictr "><img src="gambar/location.gif" class="img-fluid" alt="" style="height: 300px;">
                </div>
                <div class="gif-info">
                  <h3 class="contact-title">Location</h3>
                  <span class="contact-subtitle">Jl. Hang Tuah No.8, Madras Hulu,
                    <br>Kec. Medan Polonia, Kota Medan,
                    Sumatera Utara 20151</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <a href="#contact" target="_blank" class="contact-icons">
              <div class="gif" data-aos="zoom-in" data-aos-delay="400">
                <div class="pictr"><img src="gambar/email.gif" class="img-fluid" alt=""></div>
                <div class="gif-info">
                  <h3 class="contact-title">Email</h3>
                  <span class="contact-subtitle">UniveristasMethodist@gmail.com</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <a href="https://www.methodist.ac.id/home.do" target="_blank" class="contact-icons">
              <div class="gif" data-aos="zoom-in" data-aos-delay="400">
                <div class="pictr"><img src="gambar/browser.gif" class="img-fluid" alt=""></div>
                <div class="gif-info">
                  <h3 class="contact-title">Website</h3>
                  <span class="contact-subtitle">Universitas Methodist Indonesia</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <a href="#contact" target="_blank" class="contact-icons">
              <div class="gif" data-aos="zoom-in" data-aos-delay="400">
                <div class="pictr"><img src="gambar/phone.gif" class="img-fluid" alt=""></div>
                <div class="gif-info">
                  <h3 class="contact-title">Call / Fax</h3>
                  <span class="contact-subtitle">0614157882</span>
                </div>
              </div>
            </a>
          </div>

        </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="footer-info">
              <h3>Layanan Pengaduan Mahasiswa</h3>
              <p class="pb-3">
                <em>platform yang dirancang untuk memberikan kemudahan bagi mahasiswa
                  dalam menyampaikan keluhan, saran, dan masukan.</em>
              </p>
              <p>
                <strong>Phone:</strong> +62<br>
                <strong>Email:</strong> info@gmail.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#hero">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#about">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#service">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#termservice">Terms of service</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Our Website</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="https://www.methodist.ac.id/home.do"
                  target="_blank">Universitas Methodist Indonesia</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="https://simak.methodist.ac.id/login.do"
                  target="_blank">Simak Umi</a></li>
              <li><i class="bx bx-chevron-right"></i> <a
                  href="https://www.instagram.com/universitasmethodistindonesia/?hl=en" target="_blank">Social Media</a>
              </li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Fakultas UMI</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i><a
                  href="https://www.methodist.ac.id/content.do?tid=FakultasSastra&pid=33" target="_blank">Fakultas
                  Sastra</a></li>
              <li><i class="bx bx-chevron-right"></i><a
                  href="https://www.methodist.ac.id/content.do?tid=FakultasKedokteran&pid=33" target="_blank">Fakultas
                  Kedokteran</a></li>
              <li><i class="bx bx-chevron-right"></i><a
                  href="https://www.methodist.ac.id/content.do?tid=FakultasPertanian&pid=33" target="_blank">Fakultas
                  Pertanian</a></li>
              <li><i class="bx bx-chevron-right"></i><a
                  href="https://www.methodist.ac.id/content.do?tid=FakultasEkonomi&pid=33" target="_blank">Fakultas
                  Ekonomi</a></li>
              <li><i class="bx bx-chevron-right"></i><a
                  href="https://www.methodist.ac.id/content.do?tid=FakultasIlmuKomputer&pid=33" target="_blank">Fakultas
                  Ilmu Komputer</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

  </footer><!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>