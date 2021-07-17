<?php
//include('dbconnected.php');
include('koneksi.php');

$tgl_pengeluaran = $_GET['tgl_pengeluaran'];
$jumlah = $_GET['jumlah'];
$nama_sumber = $_GET['nama_sumber'];

//query update
$query = mysqli_query($koneksi, "INSERT INTO `pengeluaran` (`tgl_pengeluaran`, `jumlah`, `nama_sumber`) VALUES ('$tgl_pengeluaran', '$jumlah', '$nama_sumber')");

if ($query) {
    # credirect ke page index
    header("location:pengeluaran.php");
} else {
    echo "ERROR, data gagal diupdate" . mysqli_error($koneksi);
}

//mysql_close($host);
