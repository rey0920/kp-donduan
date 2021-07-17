<?php
$id_barang        = $_GET['id_barang'];
$nomor        = $_GET['nomor'];
$pembelian        = $_GET['pembelian'];
$jumlah        = $_GET['jumlah'];
$tanggal        = $_GET['tanggal'];

include "koneksi.php";
$selSto = mysqli_query($koneksi, "SELECT * FROM barang WHERE id='$id_barang'");
$sto    = mysqli_fetch_array($selSto);
$stok    = $sto['stok'];
//menghitung sisa stok
$sisa    = $stok - $jumlah;

if ($stok < $jumlah) {
?>
    <script language="JavaScript">
        alert('Oops! Jumlah pengeluaran lebih besar dari stok ...');
    </script>
    <?php
}
//proses    
else {
    $insert = mysqli_query($koneksi, "INSERT INTO barang_keluar (id_barang, nomor, pembelian, jumlah, tanggal) VALUES ('$id_barang', '$nomor', '$pembelian', '$jumlah', '$tanggal')");
    if ($insert) {
        //update stok
        $upstok = mysqli_query($koneksi, "UPDATE barang SET stok='$sisa' WHERE id='$id_barang'");

        header("location:barang-keluar.php");
    ?>
        <script language="JavaScript">
            alert('Good! Input transaksi pengeluaran barang berhasil ...');
        </script>
<?php
    } else {
        echo "<div><b>Oops!</b> 404 Error Server.</div>";
    }
}
?>