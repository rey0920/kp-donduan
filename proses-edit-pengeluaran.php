<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id_pengeluaran'];
$tgl = $_GET['tgl_pengeluaran'];
$jumlah = $_GET['jumlah'];
$nama_sumber = $_GET['nama_sumber'];

//query update
$query = mysqli_query($koneksi, "UPDATE pengeluaran SET tgl_pengeluaran='$tgl' , jumlah='$jumlah', nama_sumber='$nama_sumber' WHERE id_pengeluaran='$id' ");

if ($query) {
    # credirect ke page index
    header("location:pengeluaran.php");
} else {
    echo "ERROR, data gagal diupdate" . mysqli_error($koneksi);
}

//mysql_close($host);
