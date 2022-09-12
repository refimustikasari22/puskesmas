<?php
// https://www.malasngoding.com
// menghubungkan koneksi database
include 'fungsi.php';

// menangkap data dari form
$nama = $_POST['nama'];
$poli = $_POST['poli'];
$antrian = $_POST['antrian'];


// menginput data ke table barang

mysqli_query($conn, "INSERT INTO antri VALUES ('$nama', '$poli', '$antrian')") or die(mysqli_error($conn));

// mengalihkan halaman kembali ke index.php
header("location:index.php");
