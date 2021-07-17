<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id'];
$nama = $_GET['nama'];
$merk = $_GET['merk'];
$harga = $_GET['harga'];
$stok = $_GET['stok'];


//query update
$query = mysqli_query($koneksi, "UPDATE barang SET nama='$nama' , merk='$merk', harga='$harga', stok='$stok' WHERE id='$id' ");

if ($query) {
    # credirect ke page index
    header("location:data-barang.php");
} else {
    echo "ERROR, data gagal diupdate" . mysqli_error($koneksi);
}

//mysql_close($host);
