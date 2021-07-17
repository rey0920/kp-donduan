<?php
//include('dbconnected.php');
include('koneksi.php');

$kode_barang = $_GET['kode_barang'];
$nama = $_GET['nama'];
$merk = $_GET['merk'];
$harga = $_GET['harga'];
$stok = $_GET['stok'];


//query update
$query = mysqli_query($koneksi, "INSERT INTO `barang` (`kode_barang`, `nama`, `merk`, `harga`, `stok`) VALUES ('$kode_barang', '$nama', '$merk', '$harga', '$stok')");

if ($query) {
    # credirect ke page index
    header("location:data-barang.php");
} else {
    echo "ERROR, data gagal diupdate" . mysqli_error($koneksi);
}

//mysql_close($host);
