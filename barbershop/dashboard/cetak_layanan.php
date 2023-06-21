<?php
// memanggil library FPDF
require('fpdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l', 'mm', 'A5');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 16);
// mencetak string
$pdf->Cell(190, 7, 'Layanan Yang Tersedia', 0, 1, 'C');
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetLeftMargin(38);
$pdf->Cell(30, 6, 'ID Layanan', 1, 0, 'C');
$pdf->Cell(60, 6, 'Nama Layanan', 1, 0,'C');
$pdf->Cell(35, 6, 'Harga Layanan', 1, 1,'C');

$pdf->SetFont('Arial', '', 10);
include 'functions.php';
$layanan = mysqli_query($conn, "select * from layanan_tambahan");
while ($row = mysqli_fetch_array($layanan)) {
    $pdf->Cell(30, 6, $row['id_layanan'], 1, 0);
    $pdf->Cell(60, 6, $row['nama_layanan'], 1, 0);
    $pdf->Cell(35, 6, $row['harga_layanan'], 1, 1);
}
$pdf->Output();
