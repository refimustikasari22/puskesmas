<?php

// memanggil library FPDF
require('vendor/fpdf/fpdf.php'); {
    date_default_timezone_set('Asia/Jakarta'); // change according timezone
    $currentTime = date('d-m-Y h:i:s A', time());
}
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 16);
// $pdf->Image('img/Logo.png', 11, 5, -400);

// mencetak string 
$pdf->Cell(280, 13, 'PUSKESMAS PATIKRAJA KEC. PATIKRAJA KAB. BANYUMAS', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(280, 13, 'LAPORAN DATA PASIEN', 0, 1, 'C');
$pdf->Cell(10, 10, '', 0, 1);
$pdf->Cell(70, 0.7, "Printed On : " . date("D-d/m/Y"), 0, 0, 'C');
$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 16);
// $pdf->Image('img/Logo.png', 262, 5, -400);
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 10, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10,);
$pdf->SetFillColor(91, 192, 222);

$pdf->Cell(35, 6, 'NIK', 1, 0, 'C', '91, 192, 222');
$pdf->Cell(40, 6, 'Nama', 1, 0, 'C', '91, 192, 222');
$pdf->Cell(30, 6, 'Jenis Kelamin', 1, 0, 'C', '91, 192, 222');
$pdf->Cell(40, 6, 'TTL', 1, 0, 'C', '91, 192, 222');
$pdf->Cell(40, 6, 'P Jawab', 1, 0, 'C', '91, 192, 222');
$pdf->Cell(40, 6, 'Diagnosa', 1, 0, 'C', '91, 192, 222');
$pdf->Cell(40, 6, 'Resep', 1, 1, 'C', '91, 192, 222');


$pdf->SetFont('Arial', '', 10);
include 'fungsi.php';
$pasien = mysqli_query($conn, "select * FROM user WHERE level IN ('pasien')");
while ($row = mysqli_fetch_array($pasien)) {

    $pdf->Cell(35, 6, $row['nik'], 1, 0, 'C');
    $pdf->Cell(40, 6, $row['nama'], 1, 0, 'C');
    $pdf->Cell(30, 6, $row['jk'], 1, 0, 'C');
    $pdf->Cell(40, 6, $row['ttl'], 1, 0, 'C');
    $pdf->Cell(40, 6, $row['jawab'], 1, 0, 'C');
    $pdf->Cell(40, 6, $row['diagnosa'], 1, 0, 'C');
    $pdf->Cell(40, 6, $row['resep'], 1, 1, 'C');
}

$pdf->Output();
