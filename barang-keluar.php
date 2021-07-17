<?php
require 'cek-sesi.php';
include 'head.php';
?>

<body id="page-top">

    <?php
    require 'koneksi.php';
    require('sidebar.php'); ?>
    <!-- Main Content -->
    <div id="content">

        <?php require('navbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0 text-gray-600">Stok Barang / <span class="text-gray-700 font-weight-bold">Barang Keluar</span></h6>

            </div>
            <!-- Content Row -->
            <div class="row">

                <!-- DataTales Example -->
                <div class="col-xl-12 col-lg-12">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-bold text-primary mt-3">Data Barang Keluar</h6>
                                <button type="button" class="btn btn-success px-3 -py-3 btn-sm" data-toggle="modal" data-target="#myModalTambah"><i class="fa fa-plus"></i> <b>Barang Keluar</b></button>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataBarang" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Nomor Transaksi</th>
                                            <th>Pembelian</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($koneksi, "SELECT barang_keluar.id, barang_keluar.id_barang, barang_keluar.nomor, barang_keluar.pembelian, barang_keluar.jumlah, barang_keluar.tanggal, barang.nama
                                        FROM barang_keluar INNER JOIN barang
                                        ON barang_keluar.id_barang = barang.id");
                                        $nomer = 1;
                                        while ($data = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <tr>
                                                <td><?= $nomer++ ?></td>
                                                <td><?= $data['nama'] ?></td>
                                                <td><?= $data['nomor'] ?></td>
                                                <td><?= $data['pembelian'] ?></td>
                                                <td><?= $data['jumlah'] ?></td>
                                                <td><?= $data['tanggal'] ?></td>
                                                <td>
                                                    <!-- Button untuk modal -->
                                                    <a href="#" type="button" class=" fa fa-edit btn btn-primary btn-md" data-toggle="modal" data-target="#myModal<?php echo $data['id']; ?>"></a>
                                                </td>
                                            </tr>
                                            <!-- Modal Edit Mahasiswa-->
                                            <div class="modal fade" id="myModal<?php echo $data['id']; ?>" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Ubah Data Barang</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form role="form" action="proses-edit-barang-keluar.php" method="get">

                                                                <?php
                                                                $id = $data['id'];
                                                                $query_edit = mysqli_query($koneksi, "SELECT barang_keluar.id, barang_keluar.id_barang, barang_keluar.nomor, barang_keluar.pembelian, barang_keluar.jumlah, barang_keluar.tanggal, barang.nama, barang.kode_barang
                                                                FROM barang_keluar INNER JOIN barang
                                                                ON barang_keluar.id_barang = barang.id WHERE barang_keluar.id='$id'");
                                                                //$result = mysqli_query($conn, $query);
                                                                while ($row = mysqli_fetch_array($query_edit)) {
                                                                ?>


                                                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                                                    <input type="hidden" name="id_barang" value="<?php echo $row['id_barang']; ?>">


                                                                    <div class="form-group">
                                                                        <label>Nama Barang</label>
                                                                        <input type="text" class="form-control" value="<?php echo $row['nama'] . '_' . $row['kode_barang']; ?>" disabled>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label>Nomer Transaksi</label>
                                                                        <input type="text" name="nomor" class="form-control" value="<?php echo $row['nomor']; ?>">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Pembelian</label>
                                                                        <select name="pembelian" id="pembelian" class="form-control">
                                                                            <option value="Toko">Toko</option>
                                                                            <option value="Online">Online</option>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Jumlah Pembelian</label>
                                                                        <input type="number" name="jumlah" class="form-control" value="<?php echo $row['jumlah']; ?>">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Tanggal</label>
                                                                        <input type="date" name="tanggal" class="form-control" value="<?php echo $row['tanggal']; ?>">
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-success">Ubah</button>
                                                                        <a href="hapus-barang-keluar.php?id=<?= $row['id']; ?>&id_barang=<?= $row['id_barang']; ?>&jumlah=<?= $row['jumlah']; ?>" Onclick="confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger">Hapus</a>
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                                                    </div>


                                                            </form>
                                                    <?php
                                                                }
                                                            }
                                                            //mysql_close($host);
                                                    ?>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>



                                            <!-- Modal -->
                                            <div id="myModalTambah" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- konten modal-->
                                                    <div class="modal-content">
                                                        <!-- heading modal -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Tambah Barang Keluar</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <!-- body modal -->
                                                        <form action="proses-transaksi.php" method="get">
                                                            <div class="modal-body">

                                                                Pilih Barang :

                                                                <select name="id_barang" id="id_barang" class="form-control">

                                                                    <?php
                                                                    $query    = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY nama");
                                                                    while ($d = mysqli_fetch_array($query)) { ?>

                                                                        <option value="<?php echo $d['id'] ?>"><?php echo $d['nama'] . '_' . $d['kode_barang'] ?></option>

                                                                    <?php }  ?>
                                                                </select>

                                                                Nomor Transaksi :
                                                                <input type="text" class="form-control" name="nomor">
                                                                Pembelian :
                                                                <select name="pembelian" id="pembelian" class="form-control">
                                                                    <option value="Toko">Toko</option>
                                                                    <option value="Online">Online</option>
                                                                </select>

                                                                Jumlah :
                                                                <input type="number" class="form-control" name="jumlah">

                                                                Tanggal Barang Keluar:
                                                                <input type="date" class="form-control" name="tanggal">
                                                            </div>
                                                            <!-- footer modal -->
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success">Tambah</button>
                                                                <!-- <button type="submit" class="btn btn-success">Tambah</button> -->
                                                        </form>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                                    </div>
                                                </div>

                                            </div>
                            </div>




                            </tbody>
                            </table>
                        </div>

                        <!-- Modal laporan -->
                        <div class="modal fade" id="laporan">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Download Laporan</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body d-flex justify-content-center">
                                        <button class="btn btn-success mx-2" data-toggle="modal" data-target="#laporan-excel"><i class="fas fa-download fa-sm text-white-50"></i> Excel</button>

                                        <button class="btn btn-primary mx-2" data-toggle="modal" data-target="#laporan-pdf"><i class="fas fa-download fa-sm text-white-50"></i> PDF</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal laporan Excel -->
                        <div class="modal fade" id="laporan-excel">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Download Laporan Excel</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <!-- Form laporan -->
                                    <form method="GET" action="export-pemasukan-excel.php">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="tgl_awal">Tanggal Awal</label>
                                                <input type="date" name="tgl_awal" class="form-control" id="tgl_awal" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_akhir">Tanggal Akhir</label>
                                                <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir" required>
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary btn-block" name="laporan" data-target="black"><i class="fas fa-download fa-sm text-white-50"></i> Download</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal laporan PDF -->
                        <div class="modal fade" id="laporan-pdf">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Download Laporan PDF</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <!-- Form laporan -->
                                    <form method="GET" action="export-pemasukan-pdf.php">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="tgl_awal">Tanggal Awal</label>
                                                <input type="date" name="tgl_awal" class="form-control" id="tgl_awal" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_akhir">Tanggal Akhir</label>
                                                <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir" required>
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary btn-block" name="laporan" data-target="black"><i class="fas fa-download fa-sm text-white-50"></i> Download</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <?php require 'footer.php' ?>

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php require 'logout-modal.php'; ?>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>

    <script>
        $(document).ready(function() {
            $('#dataBarang').DataTable();
        });
    </script>

</body>

</html>