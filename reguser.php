<?php
require 'fungsi.php';

if (isset($_POST["reguser"])) {
    if (reguser($_POST) > 0) {
        echo "<script>
            alert('User baru berhasil di tambahkan');
            document.location.href = 'tabuser.php';
        </script>";
    } else {
        echo mysqli_error($conn);
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

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ce52e9cca4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/tooplate-style.css">
</head>

<body>
    <section id="appointment" data-stellar-background-ratio="3">
        <div class="container" style="padding-bottom: 100px;">
            <div class="row">
                <div class="col-md-6 col-sm-6" style="padding-top: 100px;">
                    <img src="images/reg.jpg" class="img-responsive" alt="">
                </div>
                <div class="col-md-6 col-sm-6">
                    <!-- CONTACT FORM HERE -->
                    <form id="appointment-form" role="form" method="post" action="">
                        <!-- SECTION TITLE -->
                        <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                            <h2>Registrasi User</h2>
                        </div>
                        <div class="wow fadeInUp" data-wow-delay="0.8s">
                            <div class="col-md-6 col-sm-6">
                                <label for="level">Level</label>
                                <select id="level" name="level" class="form-control" aria-readonly="true">
                                    <option value="admin">Admin</option>
                                    <option value="dokter">Dokter</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label for="nik">NIP</label>
                                <input type="number" class="form-control" id="nik" name="nik" placeholder="NIP" required>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label for="jk">Jenis Kelamin</label>
                                <select id="jk" name="jk" class="form-control">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label for="ttl">Tanggal Lahir</label>
                                <input type="date" name="ttl" id="ttl" class="form-control" required>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label for="password">Password</label>
                                <input type="text" name="password" id="password" placeholder="Password" class="form-control" required>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label for="agama">Agama</label>
                                <select class="form-control" name="agama" id="agama">
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Katolik">Katolik</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <label for="hp">Nomor HP </label>
                                <input type="number" required class="form-control" id="hp" name="hp" placeholder="Nomor Hp">
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <label for="alamat">Alamat Lengkap</label>
                                <input type="text" required name="alamat" id="alamat" placeholder="Alamat Lengkap" class="form-control">
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <button type="submit" class="btn btn-info" name="reguser">Registrasi</button>
                                <a href="tabuser.php" id="cf-submit" class="btn btn-danger">Kembali</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
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