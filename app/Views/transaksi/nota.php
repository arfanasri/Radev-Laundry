<?php

setlocale(LC_ALL, "id_ID");

$tinggi = 6;
$banyakBaris = 15;

$pdf->SetCreator("FPDF");
$pdf->SetAuthor('Muhammad Arfan Asri');
$pdf->SetTitle('Nota Laundry - ' . $transaksi["id_transaksi"]);

$pdf->SetAutoPageBreak(TRUE, 0);

$pdf->SetMargins(5, 5, 5);
$pdf->AddPage('P', "A5");
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, $tinggi * 2, 'Nama Laundry', 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, $tinggi * 2, 'Alamat Laundry', 0, 1);
$pdf->Cell(20, $tinggi, 'Nama');
$pdf->Cell(5, $tinggi, ':');
$pdf->Cell(50, $tinggi, $pelanggan["nama_pelanggan"]);
$pdf->Cell(30, $tinggi, 'No Transaksi');
$pdf->Cell(5, $tinggi, ':');
$pdf->Cell(30, $tinggi, $transaksi["id_transaksi"], 0, 1);
$pdf->SetX(80);
$pdf->Cell(30, $tinggi, 'Tanggal');
$pdf->Cell(5, $tinggi, ':');
$pdf->Cell(30, $tinggi, date("d-m-Y", strtotime($transaksi["tanggal_transaksi"])));
$pdf->SetX(5);
$pdf->Cell(20, $tinggi, 'Alamat');
$pdf->Cell(5, $tinggi, ':');
$pdf->MultiCell(50, $tinggi, $pelanggan["alamat"]);
$pdf->Cell(0, $tinggi / 2, '', 0, 1);
// Header Data
$pdf->Cell(50, $tinggi, 'Layanan', 'TBR', 0, 'C');
$pdf->Cell(30, $tinggi, 'Biaya', 'TBR', 0, 'C');
$pdf->Cell(20, $tinggi, 'Banyak', 'TBR', 0, 'C');
$pdf->Cell(35, $tinggi, 'Subtotal', 'TB', 1, 'C');
// Isi Data
$pdf->SetFont('Arial', '', 10);
$banyakData = 0;
foreach ($pesanan as $dt) {
    $pdf->Cell(50, $tinggi, $dt["nama_layanan"], 'TBR');
    $pdf->Cell(30, $tinggi, rupiah($dt["harga"], ' '), 'TBR', 0, 'C');
    $pdf->Cell(20, $tinggi, $dt["banyak"], 'TBR', 0, 'C');
    $pdf->Cell(35, $tinggi, rupiah($dt["harga_subtotal"], ' '), 'TB', 1, 'C');
    $banyakData += 1;
}
for ($i = $banyakData; $i < $banyakBaris; $i++) {
    $pdf->Cell(50, $tinggi, '', 'TBR');
    $pdf->Cell(30, $tinggi, '', 'TBR');
    $pdf->Cell(20, $tinggi, '', 'TBR');
    $pdf->Cell(35, $tinggi, '', 'TB', 1);
}
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(100, $tinggi, 'Total', 'R', 0, 'R');
$pdf->Cell(35, $tinggi, rupiah($transaksi["harga_total"], ' '), 0, 1, 'C');

$pdf->Cell(0, $tinggi, '', 0, 1);
// Tanda tangan
$pdf->Cell(68, $tinggi, 'Tanda Terima', 0, 0, 'C');
$pdf->Cell(68, $tinggi, 'Hormat Kami', 0, 1, 'C');
$pdf->Cell(0, $tinggi * 3, '', 0, 1);
$pdf->Cell(68, $tinggi, '( . . . . . . . . . . . . . . . )', 0, 0, 'C');
$pdf->Cell(68, $tinggi, '( . . . . . . . . . . . . . . . )', 0, 1, 'C');
$pdf->Output();
exit();