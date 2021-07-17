    <?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Laporan Keuangan Keseluruhan.xls");

	$total_seluruh1 = 0;
	$total_seluruh2 = 0;

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
		// Load file koneksi.php  
		$no = 1;
		include "../../koneksi.php";
		// Buat query untuk menampilkan semua data siswa 
		$query = mysqli_query($koneksi, "SELECT * FROM pemasukan");
		// Untuk penomoran tabel, di awal set dengan 1 
		while ($data = mysqli_fetch_array($query)) {
			$total_seluruh1 += $data['jumlah'];
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
		echo "<td colspan='1'>" . 'Rp.' . number_format($total_seluruh1, 0, ',', '.') . "</td>";
		echo "</tr>"; ?>
    </table>
    <br>
    <br>
    <h3>Data Pengeluaran</h3>
    <table border="1" cellpadding="5">
    	<tr>
    		<th>No</th>
    		<th>Tanggal Pengeluaran</th>
    		<th>Sumber</th>
    		<th>Jumlah</th>
    	</tr>
    	<?php
		$i = 1;
		// Buat query untuk menampilkan semua data siswa 
		$query = mysqli_query($koneksi, "SELECT * FROM pengeluaran");
		// Untuk penomoran tabel, di awal set dengan 1 
		while ($data = mysqli_fetch_array($query)) {
			$total_seluruh2 += $data['jumlah'];
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
		echo "<td colspan='1'>" . 'Rp.' . number_format($total_seluruh2, 0, ',', '.') . "</td>";
		echo "</tr>"; ?>
    </table>