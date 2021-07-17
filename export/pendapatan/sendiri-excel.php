<?php
include "../../koneksi.php";

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Pemasukan.xls");

$total_seluruh = 0;
$no = 1;
?>
<h3>Data Pemasukan</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Tanggal Pemasukan</th>
        <th>Sumber</th>
        <th>Jumlah</th>
    </tr>
    <?php
    $laporan = mysqli_query($koneksi, "SELECT * FROM pemasukan");
    // Untuk penomoran tabel, di awal set dengan 1 
    while ($data = mysqli_fetch_array($laporan)) {
        $total_seluruh += $data['jumlah'];
        // Ambil semua data dari hasil eksekusi $sql 
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $data['tgl_pemasukan'] . "</td>";
        echo "<td>" . $data['nama_sumber'] . "</td>";
        echo "<td>" . 'Rp.' . number_format($data['jumlah'], 0, ',', '.') . "</td>";
        echo "</tr>";
    }
    echo "<tr>";
    echo "<td colspan='3' align='center'>" . 'Total' . "</td>";
    echo "<td colspan='1'>" . 'Rp.' . number_format($total_seluruh, 0, ',', '.') . "</td>";
    echo "</tr>"; ?>
</table>