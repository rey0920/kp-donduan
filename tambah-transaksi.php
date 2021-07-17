<?php
error_reporting(0);
require 'cek-sesi.php';
include 'head.php';
?>

<body id="page-top">

    <?php
    require 'koneksi.php';
    require('sidebar.php');
    ?>
    <!-- Main Content -->
    <div id="content">

        <?php require('navbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <div class="mb-4">
                <h6 class="mb-0 text-gray-600">Stok Barang / <span class="text-gray-700 font-weight-bold">Barang Keluar</span></h6>
            </div>

            <!-- DataTales Example -->
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-bold text-primary mt-3">Barang Keluar</h6>
                                <button type="button" class="btn btn-success px-3 -py-3 btn-sm" data-toggle="modal" data-target="#myModalTambah"><i class="fa fa-plus"></i> <b>Barang Keluar</b></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataBarang" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Nama</th>
                                            <th>Merk</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($koneksi, "SELECT * FROM barang");
                                        $no = 1;
                                        while ($data = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data['kode_barang'] ?></td>
                                                <td><?= $data['nama'] ?></td>
                                                <td><?= $data['merk'] ?></td>
                                                <td>Rp. <?= number_format($data['harga'], 2, ',', '.'); ?></td>
                                                <td><?= $data['stok'] ?></td>
                                                <td>
                                                    <!-- Button untuk modal -->
                                                    <a href="#" type="button" class=" fa fa-edit btn btn-primary btn-md" data-toggle="modal" data-target="#myModal<?php echo $data['id']; ?>"></a>
                                                </td>
                                            </tr>
                                            <!-- Modal Edit Mahasiswa-->
                                            <div class="modal fade" id="myModal<?php echo $data['id']; ?>" role="dialog">
                                                <div class="modal-dialog">
                                                <?php } ?>
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah Data Pengeluaran</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" action="proses-edit-pengeluaran.php" method="get">

                                                            <?php
                                                            $id = $data['id'];
                                                            $query_edit = mysqli_query($koneksi, "SELECT * FROM barang_keluar WHERE id='$id'");
                                                            //$result = mysqli_query($conn, $query);
                                                            while ($row = mysqli_fetch_array($query_edit)) {
                                                            ?>


                                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                                                <div class="form-group">
                                                                    <label>Kode Barang</label>
                                                                    <input type="text" name="kode_barang" class="form-control" value="<?php echo $row['kode_barang']; ?>" disabled>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Nama Barang</label>
                                                                    <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Merk</label>
                                                                    <input type="text" name="merk" class="form-control" value="<?php echo $row['merk']; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Harga</label>
                                                                    <input type="number" name="harga" class="form-control" value="<?php echo $row['harga']; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Stok</label>
                                                                    <input type="text" name="stok" class="form-control" value="<?php echo $row['stok']; ?>">
                                                                </div>


                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success">Ubah</button>
                                                                    <a href="hapus-pengeluaran.php?id=<?= $row['id']; ?>" Onclick="confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger">Hapus</a>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                                                </div>
                                                            <?php
                                                            }
                                                            //mysql_close($host);
                                                            ?>

                                                        </form>
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
            $('#barangKeluar').DataTable();
        });
    </script>

</body>

</html>