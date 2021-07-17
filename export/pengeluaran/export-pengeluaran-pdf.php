<?php
require('../fpdf183/fpdf.php');

include "../../koneksi.php";

if (isset($_GET["laporan"])) {
	$tgl_awal = $_GET["tgl_awal"];
	$tgl_akhir = $_GET["tgl_akhir"];
	if ($tgl_awal > $tgl_akhir) {
		echo "
			<script>
				alert('Tanggal Awal Tidak Boleh Lebih Besar Daripada Tanggal Akhir');
				document.location.href = 'index.php';
			</script>
			";
	} else {
		$laporan = mysqli_query($koneksi, "SELECT * FROM pengeluaran WHERE tgl_pengeluaran BETWEEN '$tgl_awal' and DATE_ADD('$tgl_akhir',INTERVAL 1 DAY)");
	}
}

$pdf = new FPDF('P', 'mm', 'A4');

$pdf->AddPage();

$pdf->SetFont('Times', 'B', 16);
$pdf->Cell(0, 7, 'Laporan Pengeluaran Don Duan Parts', 0, 1, 'C');
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 7, 'Bks Cyber Park, Mall,', 0, 1, 'C');
$pdf->Cell(0, 7, 'Jl. KH. Noer Ali No.17A, RT.001/RW.020,', 0, 1, 'C');
$pdf->Cell(0, 7, 'Kayuringin Jaya, Kec. Bekasi Sel., Kota Bks, Jawa Barat 17144', 0, 1, 'C');
$pdf->Cell(10, 7, '', 0, 1);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 7, 'Tanggal Laporan ' . $tgl_awal . ' sampai ' . $tgl_akhir . '', 0, 1, 'C');

$pdf->Cell(10, 7, '', 0, 1);

$pdf->SetLeftMargin(28);

$pdf->SetFont('Times', 'B', 10);

$width_cell = array(10, 50, 40, 50, 100, 50);
$pdf->SetFillColor(193, 229, 252); // Background color of header 
// Header starts /// 
$pdf->Cell($width_cell[0], 10, 'No', 1, 0, 'C', true); // First header column 
$pdf->Cell($width_cell[1], 10, 'Tanggal Pengeluaran', 1, 0, 'C', true); // Second header column
$pdf->Cell($width_cell[2], 10, 'Sumber', 1, 0, 'C', true); // Third header column 
$pdf->Cell($width_cell[3], 10, 'Jumlah', 1, 1, 'C', true); // Fourth header column
//// header is over ///////


$pdf->SetFont('Times', '', 10);

$total_seluruh = 0;
$no = 1;

while ($data = mysqli_fetch_array($laporan)) {
	$total_seluruh += $data['jumlah'];
	// First row of data 
	$pdf->Cell($width_cell[0], 10, $no++, 1, 0, 'C', false); // First column of row 1 
	$pdf->Cell($width_cell[1], 10, $data['tgl_pengeluaran'], 1, 0, 'C', false); // Second column of row 1 
	$pdf->Cell($width_cell[2], 10, $data['nama_sumber'], 1, 0, 'C', false); // Third column of row 1 
	$pdf->Cell($width_cell[3], 10, 'Rp.' . number_format($data['jumlah'], 0, ',', '.') . '', 1, 1, 'C', false); // Fourth column of row 1 
	//  First row of data is over 
}

$pdf->SetFont('Times', 'B', 10);
$pdf->Cell($width_cell[4], 10, 'Total', 1, 0, 'C', true);
$pdf->SetFont('Times', '', 10);
$pdf->Cell($width_cell[5], 10, 'Rp.' . number_format($total_seluruh, 0, ',', '.') . '', 1, 1, 'C', true);


$pdf->Output('Laporan_Pengeluaran_' . $tgl_awal . '-' . $tgl_akhir . '.pdf', 'D');
