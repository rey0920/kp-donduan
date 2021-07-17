<?php
//include('dbconnected.php');
include('koneksi.php');

$nama = $_GET['nama'];
$email = $_GET['email'];
$pass = md5($_GET['pass']);
$level = $_GET['level'];


//query update
$query = mysqli_query($koneksi, "INSERT INTO `admin` (`nama`, `email`, `pass`, `level`) VALUES ('$nama', '$email', '$pass', '$level')");

if ($query) {
    # credirect ke page index
    header("location:data-user.php");
} else {
    echo "ERROR, data gagal diupdate" . mysqli_error($koneksi);
}

//mysql_close($host);
