<?php
// memanggil library FPDF
require('fpdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('p', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 16);
// mencetak string
$pdf->Cell(190, 7, 'Potongan Yang Tersedia', 0, 1, 'C');
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetLeftMargin(37);
$pdf->Cell(40, 10, 'ID Potongan', 1, 0, 'C');
$pdf->Cell(40, 10, 'Nama Potongan', 1, 0,'C');
$pdf->Cell(60, 10, 'Gambar Potongan', 1, 1,'C');

$pdf->SetFont('Arial', '', 10);
include 'functions.php';
$layanan = mysqli_query($conn, "select * from potongan_rambut");
while ($row = mysqli_fetch_array($layanan)) {
	$image1 = "img/".$row['gbr_potongan'];
    $pdf->Cell(40, 40, $row['id_potongan'], 1, 0, 'C');
    $pdf->Cell(40, 40, $row['nama_potongan'], 1, 0, 'C');
    $pdf->Cell(60, 40, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 60, 40), 1, 1, 'L', false);
}

$pdf->Output();
