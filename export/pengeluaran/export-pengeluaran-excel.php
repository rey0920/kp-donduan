    <?php
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

		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Data_Pengeluaran_$tgl_awal-$tgl_akhir.xls");
	}

	$total_seluruh = 0;
	$no = 1;
	?>
    <h3>Data Pengeluaran</h3>
    <table border="1" cellpadding="5">
    	<tr>
    		<th>No</th>
    		<th>Tanggal Pengeluaran</th>
    		<th>Sumber</th>
    		<th>Jumlah</th>
    	</tr>
    	<?php

		// Untuk penomoran tabel, di awal set dengan 1 
		while ($data = mysqli_fetch_array($laporan)) {
			$total_seluruh += $data['jumlah'];
			// Ambil semua data dari hasil eksekusi $sql 
			echo "<tr>";
			echo "<td>" . $no++ . "</td>";
			echo "<td>" . $data['tgl_pengeluaran'] . "</td>";
			echo "<td>" . $data['nama_sumber'] . "</td>";
			echo "<td>" . 'Rp.' . number_format($data['jumlah'], 0, ',', '.') . "</td>";
			echo "</tr>";
		}
		echo "<tr>";
		echo "<td colspan='3' align='center'>" . 'Total' . "</td>";
		echo "<td colspan='1'>" . 'Rp.' . number_format($total_seluruh, 0, ',', '.') . "</td>";
		echo "</tr>"; ?>
    </table>