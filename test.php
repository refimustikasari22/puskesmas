<?php

// https://www.malasngoding.com
// menghubungkan dengan koneksi database
include 'fungsi.php';

// mengambil data barang dengan kode paling besar
$query = mysqli_query($conn, "SELECT max(antrian) as kodeTerbesar FROM antri");
$data = mysqli_fetch_array($query);
$kodeBarang = $data['kodeTerbesar'];

// mengambil angka dari kode barang terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
$urutan = (int) substr($kodeBarang, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;

// membentuk kode barang baru
// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
$huruf = "BRG";
$kodeBarang = $huruf . sprintf("%03s", $urutan);
echo $kodeBarang;
echo $kodeBarang;
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <input type="text" class="form-control" id="antrian" name="antrian" value="<?php echo $kodeBarang ?>" readonly>
</body>

</html>