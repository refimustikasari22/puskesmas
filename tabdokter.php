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
$antrian = mysqli_query($conn, "SELECT * FROM antri");
$dokter = mysqli_query($conn, "SELECT * FROM dokter");

if (isset($_POST["dokter"])) {
    if (dokter($_POST) > 0) {
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
            <a class="nav-link" style="color: black; background-color: #f8f9fa;" href="admin.php">Tabel Pasien</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color: black; background-color: #f8f9fa;" href="tabbaru.php">Tabel Pasien Baru</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color: black; background-color: #f8f9fa;" href="tabantrian.php">Tabel Antrian</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" style="background-color: #a5c422;" href="tabdokter.php">Tabel Jadwal Dokter</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" style="color: black; background-color: #f8f9fa;" aria-current="page" href="tabuser.php">Tabel User</a>
        </li>
    </ul>
    <br>
    <br>
    <br>
    <div class="container">

        <h3 class="text-center p-3">Tabel Jadwal Dokter</h3>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Dokter
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Dokter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col">
                                    <label for="poli" class="form-label">Poli</label>
                                    <select id="poli" name="poli" class="form-select" required>
                                        <option value="Umum" selected>Umum</option>
                                        <option value="GigiMulut">Gigi dan Mulut</option>
                                        <option value="KIA">KIA</option>
                                        <option value="Bersalin">Bersalin</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="nama" class="form-label">Pelayanan</label>
                                    <select class="form-control" id="nama" name="nama">
                                        <?php
                                        $query = $conn->query("SELECT * FROM user WHERE level IN ('dokter')");
                                        while ($row = $query->fetch_assoc()) :
                                        ?>
                                            <option value="<?= $row['nama']; ?>"><?= $row['nama']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <label for="jadwal" class="form-label">Jadwal</label>
                                    <input type="text" id="jadwal" name="jadwal" class="form-control" placeholder="Jadwal">
                                </div>
                                <div class="col">
                                    <label for="kode" class="form-label">Kode Poli</label>
                                    <select id="kode" name="kode" class="form-select">
                                        <option value="UMM" selected>Umum</option>
                                        <option value="GDM">Gigi dan Mulut</option>
                                        <option value="KIA">KIA</option>
                                        <option value="BRS">Bersalin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" name="dokter" type="submit">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover text-nowrap mt-3 mb-5">
                <thead>
                    <tr>
                        
                        <th scope="col">Poli</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jadwal</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dokter as $row) : ?>
                        <tr>
                            
                            <td><?= $row["poli"]; ?></td>
                            <td><?= $row["nama"]; ?></td>
                            <td><?= $row["jadwal"]; ?></td>
                            <td>
                                <a class="btn btn-warning text-white" href="editdokter.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?')" class="text-white text-decoration-none">Edit</a>
                                <a class="btn btn-secondary text-white" href="hapusdokter.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?')" class="text-white text-decoration-none">Hapus</a>
                            </td>
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