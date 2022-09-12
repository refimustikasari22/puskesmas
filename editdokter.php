<?php
require 'fungsi.php';

//ambil data url
$id = $_GET["id"];
//query data mahasiswa berdasarkan id
$blt = query("SELECT * FROM dokter WHERE id=$id")[0];

// cek tombol submite
if (isset($_POST["submit"])) {
    if (ubahdokter($_POST) > 0) {
        echo "
            <script>
                alert('Data Berhasil Di Ubah');
                document.location.href = 'tabdokter.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Gagal Di Ubah');
                document.location.href = 'tabdokter.php';
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
                <h2>Halaman Edit Pasien Puskesmas Patikraja</h2>
            </blockquote>
            <figcaption class="blockquote-footer">
                harap mengelola data <cite title="Source Title">dengan benar</cite>
            </figcaption>
        </figure>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $blt["id"]; ?>">
            <div class="row">
                <div class="col">
                    <label for="poli" class="form-label">Poli</label>
                    <select id="poli" name="poli" class="form-select">
                        <option selected><?= $blt["poli"]; ?></option>
                        <option value="Umum">Umum</option>
                        <option value="GigiMulut">Gigi dan Mulut</option>
                        <option value="KIA">KIA</option>
                        <option value="Bersalin">Bersalin</option>
                    </select>
                </div>
                <div class="col">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" required value="<?= $blt["nama"]; ?>">
                </div>
            </div>
            <div class="row">

                <div class="col-6">
                    <label for="jadwal" class="form-label">Jadwal</label>
                    <input type="text" id="jadwal" name="jadwal" class="form-control" placeholder="Jadwal" required value="<?= $blt["jadwal"]; ?>">
                </div>
                <div class="col">
                    <label for="kode" class="form-label">Kode</label>
                    <select id="kode" name="kode" class="form-select">
                        <option selected><?= $blt["kode"]; ?></option>
                        <option value="UMM">Umum</option>
                        <option value="GDM">Gigi dan Mulut</option>
                        <option value="KIA">KIA</option>
                        <option value="BRS">Bersalin</option>
                    </select>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-6">
                    <a class="text-white text-decoration-none btn btn-danger" href="tabdokter.php">Kembali</a>
                    <button class="btn btn-primary" name="submit" type="submit">Save changes</button>
                </div>
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