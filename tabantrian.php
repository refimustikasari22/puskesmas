<?php
include  'fungsi.php';
$jmldatahalaman = 10;
$jmldata = count(query("SELECT * FROM user WHERE level IN ('pasien')"));
$jmlhalaman = ceil(($jmldata / $jmldatahalaman));
$halaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awaldata = ($jmldatahalaman * $halaktif) - $jmldatahalaman;


// ORDER BY nama ASC 
$pasien = mysqli_query($conn, "SELECT * FROM user WHERE level IN ('pasien') LIMIT $awaldata,$jmldatahalaman");
$pasienBaru = mysqli_query($conn, "SELECT * FROM user WHERE level IN ('pasienbaru')");
$bersalin = mysqli_query($conn, "SELECT * FROM antrian WHERE poli='BRS' ORDER BY antrian ASC");
$umum = mysqli_query($conn, "SELECT * FROM antrian WHERE poli='UMM' ORDER BY antrian ASC");
$gigimulut = mysqli_query($conn, "SELECT * FROM antrian WHERE poli='GDM' ORDER BY antrian ASC");
$kia = mysqli_query($conn, "SELECT * FROM antrian WHERE poli='KIA' ORDER BY antrian ASC");
$dokter = mysqli_query($conn, "SELECT * FROM dokter");

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


<div class="d-flex bd-highlight mb-3">
        <div class="ms-auto p-2 bd-highlight">
            <a href="logout.php" class="btn btn-danger me-md-2">
                <span class="text">Logout</span>
            </a>   
        </div>
    </div>

    <figure class="text-center p-5">
        <blockquote class="blockquote">
            <h2>Halaman Admin Puskesmas Patikraja</h2>
        </blockquote>
        <figcaption class="blockquote-footer">
            harap mengelola data <cite title="Source Title">dengan benar</cite>
        </figcaption>
    </figure>
    <ul class="nav nav-pills nav-fill">
        <li class=" nav-item">
            <a class="nav-link" style="color: black; background-color: #f8f9fa;" aria-current="page" href="admin.php">Tabel Pasien</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color: black; background-color: #f8f9fa;" href="tabbaru.php">Tabel Pasien Baru</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" style="background-color: #a5c422;" href="tabantrian.php">Tabel Antrian</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color: black; background-color: #f8f9fa;" href="tabdokter.php">Tabel Jadwal Dokter</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color: black; background-color: #f8f9fa;" href="tabuser.php">Tabel User</a>
        </li>
    </ul>
    <br>
    <br>
    <br>
    <div class="container">

        <h3 class="text-center p-3">Tabel Antrian Umum</h3>
        <div class="table-responsive">
            <table class="table table-striped table-hover text-nowrap">
                <thead>
                    <tr>
                        
                        <th scope="col">Nama</th>
                        <th scope="col">NIK</th>
                        <th scope="col">POLI</th>
                        <th scope="col">ANTRIAN</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($umum as $row) : ?>
                        <tr>
                            
                            <td><?= $row["nama"]; ?></td>
                            <td><?= $row["nik"]; ?></td>
                            <td><?= $row["poli"]; ?></td>
                            <td><?= $row["antrian"]; ?></td>
                            <td>
                                <a class="btn btn-secondary text-white" href="hapusantri.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?')" class="text-white text-decoration-none">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <br>
        <h3 class="text-center p-3">Tabel Antrian Bersalin</h3>
        <div class="table-responsive">
            <table class="table table-striped table-hover text-nowrap">
                <thead>
                    <tr>
                        
                        <th scope="col">Nama</th>
                        <th scope="col">NIK</th>
                        <th scope="col">POLI</th>
                        <th scope="col">ANTRIAN</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bersalin as $row) : ?>
                        <tr>
                            
                            <td><?= $row["nama"]; ?></td>
                            <td><?= $row["nik"]; ?></td>
                            <td><?= $row["poli"]; ?></td>
                            <td><?= $row["antrian"]; ?></td>
                            <td>
                                <a class="btn btn-secondary text-white" href="hapusantri.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?')" class="text-white text-decoration-none">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <br>
        <h3 class="text-center p-3">Tabel Antrian KIA</h3>
        <div class="table-responsive">
            <table class="table table-striped table-hover text-nowrap">
                <thead>
                    <tr>
                        
                        <th scope="col">Nama</th>
                        <th scope="col">NIK</th>
                        <th scope="col">POLI</th>
                        <th scope="col">ANTRIAN</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kia as $row) : ?>
                        <tr>
                            
                            <td><?= $row["nama"]; ?></td>
                            <td><?= $row["nik"]; ?></td>
                            <td><?= $row["poli"]; ?></td>
                            <td><?= $row["antrian"]; ?></td>
                            <td>
                                <a class="btn btn-secondary text-white" href="hapusantri.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?')" class="text-white text-decoration-none">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <br>
        <h3 class="text-center p-3">Tabel Antrian Gigi Mulut</h3>
        <div class="table-responsive">
            <table class="table table-striped table-hover text-nowrap">
                <thead>
                    <tr>
                        
                        <th scope="col">Nama</th>
                        <th scope="col">NIK</th>
                        <th scope="col">POLI</th>
                        <th scope="col">ANTRIAN</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gigimulut as $row) : ?>
                        <tr>
                            
                            <td><?= $row["nama"]; ?></td>
                            <td><?= $row["nik"]; ?></td>
                            <td><?= $row["poli"]; ?></td>
                            <td><?= $row["antrian"]; ?></td>
                            <td>
                                <a class="btn btn-secondary text-white" href="hapusantri.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?')" class="text-white text-decoration-none">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <br>
        <a href="truncate.php" onclick="return confirm('Yakin?')" class="btn btn-danger">Kosongkan Antrian</a>
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