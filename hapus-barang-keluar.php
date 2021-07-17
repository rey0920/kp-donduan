<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id'];
$id_barang = $_GET['id_barang'];
$jumlah = $_GET['jumlah'];

include "koneksi.php";
// query untuk mengambil stok barang bedasarkan id barang
$cekbarang = mysqli_query($koneksi, "SELECT * FROM barang where id = '$id_barang'");
$ambilbarang = mysqli_fetch_array($cekbarang);
$stoksekarang = $ambilbarang['stok'];

// Selisih stok sekarang yang dijumlahkan jumlah di barang keluar
$selisih = $stoksekarang + $jumlah;

// query untuk update stok barang dan menghapus dari data barang keluar
$update_barang = mysqli_query($koneksi, "UPDATE barang SET stok= '$selisih' WHERE id='$id_barang'");
$hapus_barangkeluar = mysqli_query($koneksi, "DELETE FROM barang_keluar WHERE id = '$id'");
// Jika update stok dan hapus barang keluar terpenuhi
if ($hapus_barangkeluar && $update_barang) {
    echo "
    <script>
        alert('Data Barang Keluar Berhasil Dihapuskan!');
        document.location.href = 'barang-keluar.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Data Barang Keluar Gagal Dihapuskan!');
        document.location.href = 'barang-keluar.php';
    </script>
    ";
}

//mysql_close($host);
