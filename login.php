<?php

session_start();

if (isset($_SESSION["login"])) {
     header("location:  index.php");
     exit;
}
require 'fungsi.php';
//kondisi jika tombol login di tekan user
$dokter = mysqli_query($conn, "SELECT * FROM dokter"); //menampilkan jadwal dokter
if (isset($_POST["login"])) { //fungsi membedakan login

     $nama = $_POST["nama"];
     $password = $_POST["password"];

     // cek nama
     $result = mysqli_query($conn, "SELECT * FROM user WHERE nama = '$nama' and password='$password'");
     $cek = mysqli_num_rows($result);
     if ($cek > 0) {

          $data = mysqli_fetch_assoc($result);

          // cek jika user login sebagai admin
          if ($data['level'] == "pasien") {

               // buat session login dan nama
               $_SESSION['nama'] = $nama;
               $_SESSION['nik'] = $data['nik'];
               $_SESSION['level'] = "pasien";
               // alihkan ke halaman dashboard pasien
               header("location:index.php");

               // cek jika user login sebagai admin
          } else if ($data['level'] == "admin") {
               // buat session login dan nama
               $_SESSION['nama'] = $nama;
               $_SESSION['level'] = "admin";
               // alihkan ke halaman dashboard admin
               header("location:admin.php");

               // cek jika user login sebagai dokter
          } else if ($data['level'] == "dokter") {
               // buat session login dan nama
               $_SESSION['nama'] = $nama;
               $_SESSION['level'] = "dokter";
               // alihkan ke halaman dashboard dokter
               header("location:diagnosa.php");
          } else {

               // alihkan ke halaman login kembali
               header("location:login.php?pesan=gagal"); //input acak
          }
     } else {
          header("location:login.php?pesan=gagal"); //input kosong
     }
}


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


     <script src="https://kit.fontawesome.com/ce52e9cca4.js" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="css/animate.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/tooplate-style.css">
</head>

<body>

     <section id="appointment" style="padding-bottom: 50px;" data-stellar-background-ratio="3">
          <div class="container">
               <div class="row">
                    <div class="col-md-6 col-sm-6">
                         <div class="text-center">
                              <!-- <img src="images/image2.jpg" alt="" width="100%" style="margin-top:-90px"> -->
                              <video autoplay loop width="100%">
                                   <source src="video.mp4" type="video/mp4">
                              </video>
                         </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                         <!-- CONTACT FORM HERE -->
                         <form id="appointment-form" role="form" method="post" action="">

                              <!-- SECTION TITLE -->
                              <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                                   <h2 class="text-center">Login</h2>
                              </div>
                              <?php
                              if (isset($_GET['pesan'])) {
                                   if ($_GET['pesan'] == "gagal") { //informasi yang muncul
                                        echo "<div class='alert'>Nama dan Password tidak sesuai !</div>";
                                   }
                              }
                              ?>
                              <div class="wow fadeInUp" data-wow-delay="0.8s">
                                   <div class="col-md-12 col-sm-12">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                                   </div>

                                   <div class="col-md-12 col-sm-12">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                   </div>
                                   <div class="col-md-12 col-sm-12" style="padding-bottom: 15px;">
                                        <a href="forget.php" class="card-link">*Lupa Password</a>
                                   </div>
                                   <div class="col-md-12 col-sm-12">
                                        <button type="submit" class="btn btn-info" name="login">Login</button>
                                        <a href="reg.php" id="cf-submit" class="btn btn-danger">Registrasi</a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                             Lihat Jadwal Dokter
                                        </button>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>

               <!-- Button trigger modal -->


               <!-- Modal -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                         <div class="modal-content">
                              <div class="modal-header">
                                   <h5 class="modal-title" id="exampleModalLabel">Daftar Dokter</h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                   </button>
                              </div>
                              <div class="modal-body">
                                   <p>Filter Jadwal Dokter : Poli/Nama/Jadwal</p>
                                   <div class="row">
                                        <div class="col-md-6">
                                             <input class="form-control" id="myInput" type="text" width="200px" placeholder="Search..">
                                        </div>
                                   </div>
                                   <div class="table-responsive">
                                        <table class="table table-striped table-hover text-nowrap text-center mt-3 mb-5">
                                             <thead>
                                                  <tr>

                                                       <th scope="col" style="text-align: center;">Poli</th>
                                                       <th scope="col" style="text-align: center;">Nama</th>
                                                       <th scope="col" style="text-align: center;">Jadwal</th>
                                                  </tr>
                                             </thead>
                                             <tbody id="myTable">
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
                         </div>
                    </div>
               </div>
          </div>
     </section>
     <!-- SCRIPTS -->

     <script src="js/jquery.sticky.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/wow.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/custom.js"></script>
     <script>
          $(document).ready(function() {
               $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
               });
          });
     </script>
</body>

</html>