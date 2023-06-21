<?php
// memanggil library FPDF
require('fpdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l', 'mm', 'A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', 'B', 16);
// mencetak string
$pdf->Cell(270, 7, 'Data Transaksi', 0, 1, 'C');
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 7, 'ID Transaksi', 1, 0, 'C');
$pdf->Cell(40, 7, 'Nama Pelanggan', 1, 0,'C');
$pdf->Cell(30, 7, 'Nomor HP', 1, 0,'C');
$pdf->Cell(22, 7, 'Kategori', 1, 0,'C');
$pdf->Cell(30, 7, 'Tanggal', 1, 0,'C');
$pdf->Cell(23, 7, 'Sesi', 1, 0,'C');
$pdf->Cell(40, 7, 'Nama Potongan', 1, 0,'C');
$pdf->Cell(40, 7, 'Pelayanan Tambahan', 1, 0,'C');
$pdf->Cell(24, 7, 'Total Bayar', 1, 1,'C');

$pdf->SetFont('Arial', '', 10);
include 'functions.php';
$tampiltransaksi = mysqli_query($conn, "select * from pesan left join layanan_tambahan on pesan.id_layanan=layanan_tambahan.id_layanan left join potongan_rambut on pesan.id_potongan=potongan_rambut.id_potongan");
while ($row = mysqli_fetch_array($tampiltransaksi)) {
    $pdf->Cell(30, 7, $row['id_transaksi'], 1, 0);
    $pdf->Cell(40, 7, $row['nama'], 1, 0);
    $pdf->Cell(30, 7, $row['no_hp'], 1, 0);
    $pdf->Cell(22, 7, $row['kategori'], 1, 0);
    $pdf->Cell(30, 7, $row['tanggal'], 1, 0);
    $pdf->Cell(23, 7, $row['waktu_pelayanan'], 1, 0);
    $pdf->Cell(40, 7, $row['nama_potongan'], 1, 0);
    $pdf->Cell(40, 7, $row['nama_layanan'], 1, 0);
    $pdf->Cell(24, 7, $row['total_harga'], 1, 1);
}
$pdf->Output();
