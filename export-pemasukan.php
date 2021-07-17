    <?php
	include "koneksi.php";

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
			$laporan = mysqli_query($koneksi, "SELECT * FROM pemasukan WHERE tgl_pemasukan BETWEEN '$tgl_awal' and DATE_ADD('$tgl_akhir',INTERVAL 1 DAY)");
		}

		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=Data_Pemasukan_$tgl_awal-$tgl_akhir.xls");
	}
	?>
    <h3>Data Pemasukan</h3>
    <table border="1" cellpadding="5">
    	<tr>
    		<th>ID Pemasukan</th>
    		<th>Tgl Pemasukan</th>
    		<th>Jumlah</th>
    		<th>Sumber</th>
    	</tr>
    	<?php

		// Untuk penomoran tabel, di awal set dengan 1 
		while ($data = mysqli_fetch_array($laporan)) {
			// Ambil semua data dari hasil eksekusi $sql 
			echo "<tr>";
			echo "<td>" . $data['id_pemasukan'] . "</td>";
			echo "<td>" . $data['tgl_pemasukan'] . "</td>";
			echo "<td>" . $data['jumlah'] . "</td>";
			echo "<td>" . $data['nama_sumber'] . "</td>";
			echo "</tr>";
		}  ?>
    </table>