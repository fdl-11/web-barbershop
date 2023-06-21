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
$pdf->Cell(190, 7, 'Dokumen Transaksi', 0, 1, 'C');
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10, 7, '', 0, 1);

$pdf->SetFont('Arial', '', 10);
include 'functions.php';
$tampiltransaksi = mysqli_query($conn, "select * from pesan left join layanan_tambahan on pesan.id_layanan=layanan_tambahan.id_layanan left join potongan_rambut on pesan.id_potongan=potongan_rambut.id_potongan order by pesan.id_transaksi desc limit 1");
while ($row = mysqli_fetch_array($tampiltransaksi)) {
	$pdf->Cell(40, 6, 'ID Transaksi', 0, 0);
	$pdf->Cell(2, 6, ':  ', 0, 0);
    $pdf->Cell(20, 6, $row['id_transaksi'], 0, 1);
    $pdf->Cell(10, 2, '', 0, 1);

    $pdf->Cell(40, 6, 'Nama', 0, 0);
    $pdf->Cell(2, 6, ':  ', 0, 0);
    $pdf->Cell(20, 6, $row['nama'], 0, 1);
    $pdf->Cell(10, 2, '', 0, 1);
    
    $pdf->Cell(40, 6, 'Nomor HP', 0, 0);
    $pdf->Cell(2, 6, ':  ', 0, 0);
    $pdf->Cell(20, 6, $row['no_hp'], 0, 1);
    $pdf->Cell(10, 2, '', 0, 1);

    $pdf->Cell(40, 6, 'Kategori', 0, 0);
    $pdf->Cell(2, 6, ':  ', 0, 0);
    $pdf->Cell(20, 6, $row['kategori'], 0, 1);
    $pdf->Cell(10, 2, '', 0, 1);

    $pdf->Cell(40, 6, 'Tanggal', 0, 0);
    $pdf->Cell(2, 6, ':  ', 0, 0);
    $pdf->Cell(20, 6, $row['tanggal'], 0, 1);
    $pdf->Cell(10, 2, '', 0, 1);

    $pdf->Cell(40, 6, 'Sesi', 0, 0);
    $pdf->Cell(2, 6, ':  ', 0, 0);
    $pdf->Cell(20, 6, $row['waktu_pelayanan'], 0, 1);
    $pdf->Cell(10, 2, '', 0, 1);

    $pdf->Cell(40, 6, 'Potongan', 0, 0);
    $pdf->Cell(2, 6, ':  ', 0, 0);
    $pdf->Cell(20, 6, $row['nama_potongan'], 0, 1);
    $pdf->Cell(10, 2, '', 0, 1);

    $pdf->Cell(40, 6, 'Layanan Tambahan', 0, 0);
    $pdf->Cell(2, 6, ':  ', 0, 0);
    $pdf->Cell(20, 6, $row['nama_layanan'], 0, 1);
    $pdf->Cell(10, 2, '', 0, 1);

    $pdf->Cell(40, 6, 'Total Harga', 0, 0);
    $pdf->Cell(2, 6, ':  ', 0, 0);
    $pdf->Cell(20, 6, $row['total_harga'], 0, 1);
    $pdf->Cell(10, 7, '', 0, 1);
    $pdf->Cell(10, 2, '', 0, 1);

	$pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(190, 7, 'Harap dicetak dan dibawa saat datang memotong rambut !!', 0, 1, 'C');
}
$pdf->Output();
