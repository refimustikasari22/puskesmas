<?php
include 'fungsi.php';
$dokter = mysqli_query($conn, "SELECT * FROM dokter");

// // mengambil data barang dengan kode paling besar
// $query = mysqli_query($conn, "SELECT max(antrian) as kodeTerbesar FROM antri");
// $data = mysqli_fetch_array($query);
// $kodeAntrian = $data['kodeTerbesar'];
// // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
// // dan diubah ke integer dengan (int)
// $urutan = (int) substr($kodeAntrian, 3, 3);
// // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
// $urutan++;
// // membentuk kode barang baru
// // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
// // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
// // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
// $huruf = "APP";
// $kodeAntrian = $huruf . sprintf("%03s", $urutan);
$UMM = query("SELECT antrian FROM antrian WHERE poli='UMM' ORDER BY antrian ASC LIMIT 1");
$GDM = query("SELECT antrian FROM antrian WHERE poli='GDM' ORDER BY antrian ASC LIMIT 1");
$KIA = query("SELECT antrian FROM antrian WHERE poli='KIA' ORDER BY antrian ASC LIMIT 1");
$BRS = query("SELECT antrian FROM antrian WHERE poli='BRS' ORDER BY antrian ASC LIMIT 1");
// mengambil data barang
$data_umum = mysqli_query($conn, "SELECT * FROM antrian WHERE poli='UMM'");
$data_gigi = mysqli_query($conn, "SELECT * FROM antrian WHERE poli='GDM'");
$data_kia = mysqli_query($conn, "SELECT * FROM antrian WHERE poli='KIA'");
$data_bersalin = mysqli_query($conn, "SELECT * FROM antrian WHERE poli='BRS'");

// menghitung data barang
$jumlah_umum = mysqli_num_rows($data_umum);
$jumlah_gigi = mysqli_num_rows($data_gigi);
$jumlah_kia = mysqli_num_rows($data_kia);
$jumlah_bersalin = mysqli_num_rows($data_bersalin);

if (isset($_POST['submit'])) {
     $nama = ucwords($_POST['nama']);
     $nik = $_POST['nik'];
     $poli = $_POST['poli'];
     $tanggal_antrian = $_POST['tanggal_antrian'];
     // cek kode barang
     // $sql = "SELECT dokter.nama FROM dokter WHERE poli = '$poli'";
     // $dokterku = $conn->query($sql);
     $result = mysqli_query($conn, "SELECT dokter.nama FROM dokter WHERE kode = '$poli'");
     $row = mysqli_fetch_array($result);
     // $result = mysqli_query($con, "SELECT classtype FROM learn_users WHERE username='abcde'");
     $sql = "SELECT max(right(antrian, 4)) AS kode_antrian FROM antrian WHERE poli = '$poli'";
     $q = $conn->query($sql);

     if ($q->num_rows > 0) {
          foreach ($q as $qq) {
               $no = ((int)$qq['kode_antrian']) + 1;
               $kd = sprintf("%04s", $no);
          }
     } else {
          $kd = "0001";
     }

     $kode = $poli . $kd;

     $sql = "INSERT INTO antrian VALUES (null,'$nama','$nik','$poli','$tanggal_antrian','$kode')";
     $q = $conn->query($sql);

     if ($q) {
          echo '<script type="text/javascript">alert("Nomor Antrian         : ' . $kode . '\nNama Anda              : ' . $nama . '\nPoli Anda                  : ' . $poli . '\nTanggal Antri            : ' . $tanggal_antrian . '\nNama Doktor           : ' . $row['nama'] . '\nData Berhasil Di Tambahkan Ke Antrian Puskesmas Patikraja");</script>';
          echo "
          <script>
          alert('Silahkan Menunggu');
              document.location.href = 'index.php';
          </script>
      ";
     } else {
          echo "<script>alert('Data barang gagal ditambahkan'; windows.location.href = '?p=data-barang';</script>";
     }
}

// if (isset($_POST["submit1212"])) {
//      if (ambilantri($_POST) > 0) {
//           echo '<script type="text/javascript">alert(" Nomor Antrian Anda Adalah : ' . $kode . '");</script>';
//           echo '<script type="text/javascript">alert(" Nomor Antrian Anda Adalah : ' . $jadwaldokter . '");</script>';
//      } else {
//           echo "
//              <script>
//              alert('Silahkan Menunggu');
//                  document.location.href = 'index.php';
//              </script>
//          ";
//      }
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <title>Puskesmas Patikraja</title>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="Tooplate">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <script src="https://kit.fontawesome.com/ce52e9cca4.js" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
     <link rel="stylesheet" href="css/animate.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/tooplate-style.css">
</head>

<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">
     <?php
     session_start();

     // cek apakah yang mengakses halaman ini sudah login
     if ($_SESSION['level'] == "") {
          header("location:login.php");
     }

     ?>
     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">
               <span class="spinner-rotate"></span>
          </div>
     </section>

     <!-- Header Navbar -->
     <header>
          <div class="container">
               <div class="row">
                    <div class="col-md-4 col-sm-5">
                         <p>Selamat Datang Di Puskesmas Patikraja</p>
                    </div>
                    <div class="col-md-8 col-sm-7 text-align-right">
                         <span class="phone-icon"><i class="fa fa-phone"></i> (0281) 6844892</span>
                         <span class="date-icon"><i class="fa fa-calendar-plus-o"></i> 07:00 - 14:00 (Sen-Kam) 07:00 - 11:00 (Jumat-Sabtu)</span>
                         <span class="email-icon"><i class="fa fa-envelope-o"></i> <a href="#">patikraja16@gmail.com</a></span>
                    </div>
               </div>
          </div>
     </header>

     <!-- Tampilan Navbar -->
     <section class="navbar navbar-default navbar-static-top" role="navigation">
          <div class="container">
               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>
                    <!-- lOGO TEXT HERE -->
                    <a href="index.html" class="navbar-brand">Puskesmas <i class="fa fa-product-hunt"></i>atikraja</a>
               </div>
               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="index.php" class="smoothScroll">Beranda</a></li>
                         <li><a href="tentangkami.php" class="smoothScroll">Tentang Kami</a></li>
                         <li><a href="layanan.php" class="smoothScroll">Layanan</a></li>
                         <li><a href="petunjuk.php" class="smoothScroll">Petunjuk</a></li>
                         <li><a href="jadwaldokter.php" class="smoothScroll">Jadwal Dokter</a></li>
                         <li><a href="antri.php" class="smoothScroll">Nomor Antrian</a></li>
                         <li><a href="logout.php" class="smoothScroll"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                         <li class="appointment-btn"><a href="ambilnomorantrian.php">Ambil Nomor Antrian</a></li>
                    </ul>
               </div>
          </div>
     </section>

     <!-- HOME -->
     <section id="home" class="slider" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">
                    <div class="owl-carousel owl-theme">
                         <div class="item item-first">
                              <div class="caption">
                                   <div class="col-md-offset-1 col-md-10">
                                        <h3>Ayo buat hidupmu lebih bahagia</h3>
                                        <h1>Hidup Sehat</h1>
                                        <a href="#team" class="section-btn btn btn-default smoothScroll">Meet Our Doctors</a>
                                   </div>
                              </div>
                         </div>
                         <div class="item item-second">
                              <div class="caption">
                                   <div class="col-md-offset-1 col-md-10">
                                        <h3>Manfaat kesehatan anda</h3>
                                        <h1>Gaya Hidup Baru</h1>
                                        <a href="#about" class="section-btn btn btn-default btn-gray smoothScroll">More About Us</a>
                                   </div>
                              </div>
                         </div>
                         <div class="item item-third">
                              <div class="caption">
                                   <div class="col-md-offset-1 col-md-10">
                                        <h3>Demi menjaga masa depan yang cerah</h3>
                                        <h1>Menjaga Kebersihan</h1>
                                        <a href="#news" class="section-btn btn btn-default btn-blue smoothScroll">Read Stories</a>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>

     <!-- ABOUT -->
     <!-- <section id="about">
          <div class="container">
               <div class="row">
                    <div class="col-md-6 col-sm-6">
                         <div class="about-info">
                              <h2 class="wow fadeInUp" data-wow-delay="0.6s">Puskesmas <i class="fa fa-product-hunt" style="color:#a5c422;"></i>atikraja</h2>
                              <div class="wow fadeInUp" data-wow-delay="0.8s">
                                   <p>Fasilitas pelayanan kesehatan yang menyelenggarakan upaya kesehatan masyarakat dan upaya kesehatan perseorangan tingkat pertama, dengan lebih mengutamakan upaya promotif dan preventif di wilayah kerjanya.</p>
                                   <p>Layanan untuk mempermudah mendaftar puskesmas dimana saja, cukup daftar online dari rumah untuk periksa hari ini besok atau lusa</p>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section> -->
     <!-- <section id="petunjuk">
          <div class="text-center">
               <video autoplay loop>
                    <source src="video.mp4" type="video/mp4">
               </video>
          </div>
     </section> -->

     <!-- Layanan -->
     <!-- <section id="layanan">
          <div class="container" style="padding-top: 100px; padding-bottom: 100px;">
               <div class="row text-center">
                    <div class="col-md-12 col-sm-12"> -->
                         <!-- SECTION TITLE -->
                         <!-- <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                              <h2>Layanan</h2>
                         </div>
                    </div>
                    <div class="col-xs-6 col-md-3">
                         <i class="fa-regular fa-eye fa-2xl" style="color:#a5c422;"></i>
                         <h3>Umum</h3>
                         <p>Poli Umum adalah pelayanan pemeriksaan medis berupa pemeriksaan kesehatan, pengobatan, dan edukasi kepada pasien dalam rangka meningkatkan kesehatan perorangan dan masyarakat</p>
                    </div>
                    <div class="col-xs-6 col-md-3">
                         <i class="fa-solid fa-tooth fa-2xl" style="color:#a5c422;"></i>
                         <h3>Gigi dan Mulut</h3>
                         <p>Poli Gigi dan Mulut adalah pelayanan pemeriksaan kesehatan gigi dan mulut, penambalan gigi, pencabutan gigi dan pembersihan karang gigi, perawatan saluran akar pada gigi interior atau gigi satu saluran akar.</p>
                    </div>
                    <div class="col-xs-6 col-md-3">
                         <i class="fa-solid fa-baby fa-2xl" style="color:#a5c422;"></i>
                         <h3>KIA</h3>
                         <p>Poli KIA (Kesehatan Ibu dan Anak) merupakan pelayanan rawat jalan di bidang kesehatan yang menyangkut pelayanan dan pemeliharaan ibu hamil, ibu menyusui, bayi dan anak balita serta anak prasekolah.</p>
                    </div>
                    <div class="col-xs-6 col-md-3">
                         <i class="fa-solid fa-person-pregnant fa-2xl" style="color:#a5c422;"></i>
                         <h3>Bersalin</h3>
                         <p>Bersalin/persalinan adalah proses pengeluaran hasil konsepsi atau yang biasa disebut sebagai janin atau bayi didalam kandungan.</p>
                    </div>
               </div>
          </div>
     </section> -->


     <!-- NEWS -->
     <!-- <section id="dokter">
          <div class="container" style="padding-top: 100px;">
               <div class="section-title wow fadeInUp text-center" data-wow-delay="0.1s">
                    <h2>Jadwal Dokter</h2>
               </div>
               <div class="table-responsive">
                    <table class="table table-striped table-hover text-nowrap mt-3 mb-5" style="text-align: center;">
                         <thead>
                              <tr>
                                   <th class="text-center" scope="col">Poli</th>
                                   <th class="text-center" scope="col">Nama</th>
                                   <th class="text-center" scope="col">Jadwal</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php foreach ($dokter as $row) : ?>
                                   <tr>
                                        <td><?= $row["poli"]; ?></td>
                                        <td><?= $row["nama"]; ?></td>
                                        <td><?= $row["jadwal"]; ?></td>
                                   </tr>
                              <?php endforeach; ?>
                         </tbody>
                    </table>
               </div>
          </div>
     </section> -->
     <!-- MAKE AN APPOINTMENT -->
     <!-- <section id="appointment" data-stellar-background-ratio="3">
          <div class="container">
               <div class="row">
                    <div class="col-md-6 col-sm-6" style="padding-top: 10px;">
                         <img src="images/1.jpg" class="img-responsive" alt="">
                    </div>
                    <div class="col-md-6 col-sm-6">
                         <form id="appointment-form" role="form" method="post"> -->

                              <!-- SECTION TITLE -->
                              <!-- <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                   <h2>Ambil Nomor Antrian</h2>
                              </div>
                              <div class="wow fadeInUp" data-wow-delay="0.8s">
                                   <div class="col-md-6 col-sm-6">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $_SESSION['nama']; ?>" readonly>
                                   </div>
                                   <div class="col-md-6 col-sm-6">
                                        <label for="nik">NIK</label>
                                        <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $_SESSION['nik']; ?>" readonly>
                                   </div> -->
                                   <!-- <div class="col-md-6 col-sm-6">
                                        <label for="poli">Pelayanan</label>
                                        <select class="form-control" id="poli" name="poli">
                                             <option value="Umum">Umum</option>
                                             <option value="GigiMulut">Gigi dan Mulut</option>
                                             <option value="KIA">KIA</option>
                                             <option value="Bersalin">Bersalin</option>
                                        </select>
                                   </div> -->
                                   <!-- <div class="col-md-6 col-sm-6">
                                        <label for="poli">Pelayanan</label>
                                        <select class="form-control" id="poli" name="poli">
                                             <?php
                                             $query = $conn->query("SELECT * FROM jenisantrian");
                                             while ($row = $query->fetch_assoc()) :
                                             ?>
                                                  <option value="<?= $row['poli']; ?>"><?= $row['nama_poli']; ?></option>
                                             <?php endwhile; ?>
                                        </select>
                                   </div>
                                   <div class="col-md-6 col-sm-6">
                                        <label for="tanggal_antrian">Tanggal Antrian</label>
                                        <input type="date" class="form-control" id="tanggal_antrian" name="tanggal_antrian" required>
                                        <button type="submit" class="form-control" id="cf-submit" name="submit">Ambil Nomor Antrian</button>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </section> -->

     <!-- <section id="antrian">
          <div class="container">
               <h3 class="text-center" style="padding-top:20px; padding-bottom:50px;">Jumlah Antrian Puskesmas</h3>
               <div class="row">
                    <div class="col-md-3">
                         <table class="table">
                              <thead style="background-color:#a5c422; color:white;">
                                   <tr>
                                        <th scope="col">Umum</th>
                                        <th scope="col">Sekarang</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <tr>
                                        <td>Tersisa <?php echo $jumlah_umum ?> Antrian</td>
                                        <?php foreach ($UMM as $row) : ?>
                                             <td><?= $row["antrian"]; ?></td>
                                        <?php endforeach; ?>
                                   </tr>
                              </tbody>
                         </table>
                    </div>
                    <div class="col-md-3">
                         <table class="table">
                              <thead style="background-color:#a5c422; color:white;">
                                   <tr class="">
                                        <th scope="col">Gigi dan Mulut</th>
                                        <th scope="col">Sekarang</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <tr>
                                        <td>Tersisa <?php echo $jumlah_gigi ?> Antrian</td>
                                        <?php foreach ($GDM as $row) : ?>
                                             <td><?= $row["antrian"]; ?></td>
                                        <?php endforeach; ?>
                                   </tr>
                              </tbody>
                         </table>
                    </div> -->
                    <!-- <div class="col-md-3">
                         <table class="table">
                              <thead style="background-color:#a5c422; color:white;">
                                   <tr class="">
                                        <th scope="col">KIA</th>
                                        <th scope="col">Sekarang</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <tr>
                                        <td>Tersisa <?php echo $jumlah_kia ?> Antrian</td>
                                        <?php foreach ($KIA as $row) : ?>
                                             <td><?= $row["antrian"]; ?></td>
                                        <?php endforeach; ?>
                                   </tr>
                              </tbody>
                         </table>
                    </div>
                    <div class="col-md-3">
                         <table class="table">
                              <thead style="background-color:#a5c422; color:white;">
                                   <tr class="">
                                        <th scope="col">Bersalin</th>
                                        <th scope="col">Sekarang</th>
                                   </tr>
                              </thead>
                              <tbody">
                                   <tr>
                                        <td>Tersisa <?php echo $jumlah_bersalin ?> Antrian</td>
                                        <?php foreach ($BRS as $row) : ?>
                                             <td><?= $row["antrian"]; ?></td>
                                        <?php endforeach; ?>

                                   </tr>
                                   </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </section> -->
     <!-- GOOGLE MAP -->
     <section id="google-map" style="padding-top: 50px;">
          <!-- How to change your own map point
            1. Go to Google Maps
            2. Click on your location point
            3. Click "Share" and choose "Embed map" tab
            4. Copy only URL and paste it within the src="" field below
	-->

          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.789492537213!2d109.21211431477626!3d-7.4884807945983125!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655d0d780c9623%3A0x16ec02a5d323d2ab!2sPuskesmas%20Patikraja!5e0!3m2!1sid!2sid!4v1656833568107!5m2!1sid!2sid" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
     </section>


     <!-- FOOTER -->
     <footer data-stellar-background-ratio="5">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-6">
                         <div class="footer-thumb">
                              <h4 class="wow fadeInUp" data-wow-delay="0.4s">Hubungi Kami</h4>
                              <p>Jl. Raya Notog, Notog, Patikraja, Kabupaten Banyumas, Jawa Tengah, Indonesia 53171</p>

                              <div class="contact-info">
                                   <p><i class="fa fa-phone"></i> (0281) 6844892</p>
                                   <p><i class="fa fa-envelope-o"></i> <a href="#">patikraja16@gmail.com</a></p>
                              </div>
                         </div>
                    </div>


                    <div class="col-md-6 col-sm-6">
                         <div class="footer-thumb">
                              <div class="opening-hours">
                                   <h4 class="wow fadeInUp" data-wow-delay="0.4s">Jam Buka</h4>
                                   <p>Senin - Kamis <span>07:00 - 14:00 </span></p>
                                   <p>Jumat - Sabtu <span>07:00 - 11:00 </span></p>
                                   <p>Miinggu <span>Tutup</span></p>
                              </div>

                              <ul class="social-icon">
                                   <li><a href="https://www.facebook.com/puskesmas.patikraja.9" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                                   <li><a href="https://www.instagram.com/patikrajapuskesmas/" class="fa fa-instagram"></a></li>
                                   <li><a href="https://www.youtube.com/channel/UCxN0HVQqYBJim1vTz-NfsuQ/videos" class="fa fa-youtube"></a></li>
                              </ul>
                         </div>
                    </div>

                    <div class="col-md-12 col-sm-12 border-top">

                         <div class="col-md-2 col-sm-2 text-align-center">
                              <div class="angle-up-btn">
                                   <a href="#top" class="smoothScroll wow fadeInUp" data-wow-delay="1.2s"><i class="fa fa-angle-up"></i></a>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </footer>

     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.sticky.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/wow.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/custom.js"></script>

</body>

</html>