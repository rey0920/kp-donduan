<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id'];
$id_barang = $_GET['id_barang'];
$nomor = $_GET['nomor'];
$pembelian = $_GET['pembelian'];
$jumlah = $_GET['jumlah'];
$tanggal = $_GET['tanggal'];

// untuk mengambil stok berdasarkan id barang
$cekbarang = mysqli_query($koneksi, "SELECT * FROM barang where id = '$id_barang'");
$ambilbarang = mysqli_fetch_array($cekbarang);
$stoksekarang = $ambilbarang['stok'];

// untuk mengambil jumlah berdasarkan id barangmasuk
$cek_barangkeluar = mysqli_query($koneksi, "SELECT * FROM barang_keluar WHERE id = '$id'");
$ambildata = mysqli_fetch_array($cek_barangkeluar);
$jumlahsekarang = $ambildata['jumlah'];


// jika jumlah lebih besar daripada jumlah sekarang dari barang keluar
if ($jumlah > $jumlahsekarang) {
    $selisih = $jumlah - $jumlahsekarang;
    $mengurangibarang = $stoksekarang - $selisih;

    // jika stok barang mencukupi untuk di edit
    if ($selisih <= $stoksekarang) {

        // kueri untuk edit data barang keluar dan mengurangi stok barang
        $mengurangistoknya = mysqli_query($koneksi, "UPDATE barang set stok = '$mengurangibarang' WHERE id = '$id_barang'");
        $update_barangkeluar = mysqli_query($koneksi, "UPDATE barang_keluar SET nomor='$nomor' , pembelian='$pembelian', jumlah='$jumlah', tanggal='$tanggal' WHERE id='$id' ");
        if ($mengurangistoknya && $update_barangkeluar) {
            echo "
                    <script>
                        alert('Data Barang Keluar Berhasil Diedit!');
                        document.location.href = 'barang-keluar.php';
                    </script>
                    ";
        } else {
            echo "
                    <script>
                        alert('Data Barang Keluar Gagal Diedit!');
                        document.location.href = 'barang-keluar.php';
                    </script>
                    ";
        }
        // Jika stok barang yang diedit tidak mencukupi agar terhindar dari stok minus
    } else {
        echo "
                <script>
                    alert('Stok Barang Tidak Mencukupi');
                    window.location.href = 'barang-keluar.php';
                </script>
        ";
    }
    // Jika jumlah yang dikeluarkan lebih kecil daripada jumlah sekarang dari barang keluar
} elseif ($jumlah < $jumlahsekarang) {
    $selisih = $jumlahsekarang - $jumlah;
    $menambahbarang = $stoksekarang + $selisih;

    // kueri untuk edit data barang keluar dan stoknya menjadi bertambah
    $menambahstoknya = mysqli_query($koneksi, "UPDATE barang set stok = '$menambahbarang' WHERE id = '$id_barang'");
    $update_barangkeluar = mysqli_query($koneksi, "UPDATE barang_keluar SET nomor='$nomor' , pembelian='$pembelian', jumlah='$jumlah', tanggal='$tanggal' WHERE id='$id' ");
    if ($menambahstoknya && $update_barangkeluar) {
        echo "
        <script>
            alert('Data Barang Keluar Berhasil Diedit!');
            document.location.href = 'barang-keluar.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data Barang Keluar Gagal Diedit!');
            document.location.href = 'barang-keluar.php';
        </script>
        ";
    }
} else {
    // kueri untuk edit data barang keluar tanpa mengubah stoknya
    $update_barangkeluar = mysqli_query($koneksi, "UPDATE barang_keluar SET nomor='$nomor' , pembelian='$pembelian', jumlah='$jumlah', tanggal='$tanggal' WHERE id='$id' ");
    if ($update_barangkeluar) {
        echo "
        <script>
            alert('Data Barang Keluar Berhasil Diedit!');
            document.location.href = 'barang-keluar.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data Barang Keluar Gagal Diedit!');
            document.location.href = 'barang-keluar.php';
        </script>
        ";
    }
}

//mysql_close($host);