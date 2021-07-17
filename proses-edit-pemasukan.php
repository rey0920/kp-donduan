<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id_pemasukan'];
$tgl = $_GET['tgl_pemasukan'];
$jumlah = $_GET['jumlah'];
$nama_sumber = $_GET['nama_sumber'];

//query update
$query = mysqli_query($koneksi, "UPDATE pemasukan SET tgl_pemasukan='$tgl' , jumlah='$jumlah', nama_sumber='$nama_sumber' WHERE id_pemasukan='$id' ");

if ($query) {
    # credirect ke page index
    header("location:pendapatan.php");
} else {
    echo "ERROR, data gagal diupdate" . mysqli_error($koneksi);
}

//mysql_close($host);
