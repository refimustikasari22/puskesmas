<?php
include  'fungsi.php';

$pasien = mysqli_query($conn, "SELECT * FROM user WHERE level IN ('pasien')");



if (isset($_POST["dokter"])) {
    if (dokter($_POST) > 0) {
        echo "<script>
            alert('Jadwal berhasil di tambahkan');
        </script>";
        header("location:admin.php");
    } else {
        echo mysqli_error($conn);
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
                <h2>Halaman Dokter Puskesmas Patikraja</h2>
            </blockquote>
            <figcaption class="blockquote-footer">
                harap mengelola data <cite title="Source Title">dengan benar</cite>
            </figcaption>
        </figure>
        <ul class="nav nav-pills nav-fill">
            <li class=" nav-item">
                <a class="nav-link active" style="background-color: #a5c422;" aria-current="page" href="diagnosa.php">Tabel Diagnosa Pasien</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: black; background-color: #f8f9fa;" href="resep.php">Tabel Resep Obat Pasien</a>
            </li>
        </ul>
        <br>
        <br>
        <a href="logout.php" class="btn btn-danger">Logout</a>
        <h3 class="text-center p-3">Tabel Diagnosa Pasien</h3>
        <div class="table-responsive">
            <table class="table table-striped table-hover text-nowrap">
                <thead>
                    <tr>
                        <th scope="col">Aksi</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">JK</th>
                        <th scope="col">Diagnosa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pasien as $row) : ?>
                        <tr>
                            <td>
                                <a class="btn btn-warning text-white" href="editdiagnosa.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?')" class="text-white text-decoration-none">Edit</a>
                            </td>
                            <td><?= $row["nik"]; ?></td>
                            <td><?= $row["nama"]; ?></td>
                            <td><?= $row["jk"]; ?></td>
                            <td><?= $row["diagnosa"]; ?></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

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