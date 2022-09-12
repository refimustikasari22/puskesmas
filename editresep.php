<?php
require 'fungsi.php';

//ambil data url
$id = $_GET["id"];
//query data mahasiswa berdasarkan id
$blt = query("SELECT * FROM user WHERE id=$id")[0];

// cek tombol submite
if (isset($_POST["submit"])) {
    if (ubahresep($_POST) > 0) {
        echo "
            <script>
                alert('Data Berhasil Di Ubah');
                document.location.href = 'resep.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Gagal Di Ubah');
                document.location.href = 'resep.php';
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
                <h2>Halaman Edit Resep Obat Pasien Puskesmas Patikraja</h2>
            </blockquote>
            <figcaption class="blockquote-footer">
                harap mengelola data <cite title="Source Title">dengan benar</cite>
            </figcaption>
        </figure>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $blt["id"]; ?>">
            <div class="row">
                <div class="col-12 m-3">
                    <label for="resep" class="form-label">Resep</label>
                    <input class="form-control" name="resep" id="resep" required value="<?= $blt["resep"]; ?>"></input>
                </div>
                <div class="col-12 m-3">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control">
                        <option value="Selesai">Selesai</option>
                        <option value="Pending">Pending</option>
                        <option value="Gagal">Gagal</option>
                    </select>
                </div>
                <div class="m-3">
                    <button type="submit" name="submit" class="btn btn-primary">Ubah</button>
                    <button class="btn btn-warning"><a class="text-white text-decoration-none" href="resep.php">Kembali</a></button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function myFunction() {
            document.getElementById("resep").value = "Fifth Avenue, New York City";
        }
    </script>
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