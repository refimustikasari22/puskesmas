<?php
require 'fungsi.php';

//ambil data url
$id = $_GET["id"];
//query data mahasiswa berdasarkan id
$blt = query("SELECT * FROM user WHERE id=$id")[0];

// cek tombol submite
if (isset($_POST["submit"])) {
    if (ubahuser($_POST) > 0) {
        echo "
            <script>
                alert('Data Berhasil Di Ubah');
                document.location.href = 'tabuser.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Gagal Di Ubah');
                document.location.href = 'tabuser.php';
            </script>
        ";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Puskesmas Patikraja</title>
</head>

<body>
    <?php
    session_start();

    // cek apakah yang mengakses halaman ini sudah login
    if ($_SESSION['level'] == "") {
        header("location:login.php");
    }

    ?>
    <div class="container">
        <figure class="text-center p-5">
            <blockquote class="blockquote">
                <h2>Halaman Edit User Puskesmas Patikraja</h2>
            </blockquote>
            <figcaption class="blockquote-footer">
                harap mengelola data <cite title="Source Title">dengan benar</cite>
            </figcaption>
        </figure>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $blt["id"]; ?>">
            <div class="row">
                <div class="col m-3">
                    <label for="level" class="form-label">Level</label>
                    <select class="form-select" name="level" id="level" >
                        <option selected><?= $blt["level"]; ?></option>
                        <option value="admin">Admin</option>
                        <option value="dokter">Dokter</option>
                    </select>
                </div>
                <div class="col m-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control" name="nik" id="nik"  value="<?= $blt["nik"]; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col m-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama"  value="<?= $blt["nama"]; ?>">
                </div>
                <div class="col m-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email"  value="<?= $blt["email"]; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col m-3">
                    <label for="jk" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name="jk" id="jk" >
                        <option selected><?= $blt["jk"]; ?></option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="col m-3">
                    <label for="ttl" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="ttl" name="ttl"  value="<?= $blt["ttl"]; ?>">
                </div>

                <input type="text" class="form-control" id="password" name="password" hidden  value="<?= $blt["password"]; ?>">

            </div>
            <div class="row">
                <div class="col m-3">
                    <label for="agama" class="form-label">Agama</label>
                    <select class="form-select" name="agama" id="agama">
                        <option selected><?= $blt["agama"]; ?></option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Budha">Budha</option>
                        <option value="Katolik">Katolik</option>
                    </select>
                </div>
                <div class="col m-3">
                    <label for="hp" class="form-label">Nomer HP</label>
                    <input type="number" class="form-control" id="hp" name="hp"  value="<?= $blt["hp"]; ?>">
                </div>
            </div>
            <div class="row">
                <div class="col m-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat"  value="<?= $blt["alamat"]; ?>">
                </div>
            </div>
            <div class="m-3">
                <button type="submit" name="submit" class="btn btn-primary">Ubah</button>
                <a class="text-white text-decoration-none btn btn-danger" href="tabuser.php">Kembali</a>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>