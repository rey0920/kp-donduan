<?php
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

      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h6 class="mb-0 text-gray-600">Keuangan / <span class="text-gray-700 font-weight-bold">Pengeluaran</span></h6>
        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#laporan"><i class="fas fa-download fa-sm text-white-50"></i> Download Laporan</button>

      </div>

      <!-- DataTales Example -->
      <div class="row">
        <div class="col-xl-12 col-lg-12">
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <div class="d-flex justify-content-between">
                <h6 class="font-weight-bold text-primary mt-3">Transaksi Pengeluaran</h6>
                <button type="button" class="btn btn-success px-3 -py-3 btn-sm" data-toggle="modal" data-target="#myModalTambah"><i class="fa fa-plus"></i> <b>Pengeluaran</b></button>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="transaksiPengeluaran" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Jumlah</th>
                      <th>Sumber</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM pengeluaran");
                    $nomer = 1;
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                      <tr>
                        <td><?= $nomer++ ?></td>
                        <td><?= $data['tgl_pengeluaran'] ?></td>
                        <td>Rp. <?= number_format($data['jumlah'], 2, ',', '.'); ?></td>
                        <td><?= $data['nama_sumber'] ?></td>
                        <td>
                          <!-- Button untuk modal -->
                          <a href="#" type="button" class=" fa fa-edit btn btn-primary btn-md" data-toggle="modal" data-target="#myModal<?php echo $data['id_pengeluaran']; ?>"></a>
                        </td>
                      </tr>
                      <!-- Modal Edit Mahasiswa-->
                      <div class="modal fade" id="myModal<?php echo $data['id_pengeluaran']; ?>" role="dialog">
                        <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Ubah Data Pengeluaran</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                              <form role="form" action="proses-edit-pengeluaran.php" method="get">

                                <?php
                                $id = $data['id_pengeluaran'];
                                $query_edit = mysqli_query($koneksi, "SELECT * FROM pengeluaran WHERE id_pengeluaran='$id'");
                                //$result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($query_edit)) {
                                ?>


                                  <input type="hidden" name="id_pengeluaran" value="<?php echo $row['id_pengeluaran']; ?>">

                                  <div class="form-group">
                                    <label>Id</label>
                                    <input type="text" name="id_pengeluaran" class="form-control" value="<?php echo $row['id_pengeluaran']; ?>" disabled>
                                  </div>

                                  <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" name="tgl_pengeluaran" class="form-control" value="<?php echo $row['tgl_pengeluaran']; ?>">
                                  </div>

                                  <div class="form-group">
                                    <label>Jumlah</label>
                                    <input type="text" name="jumlah" class="form-control" value="<?php echo $row['jumlah']; ?>">
                                  </div>

                                  <div class="form-group">
                                    <label>Sumber</label>
                                    <select class="form-control" name="nama_sumber">
                                      <option value="Pembelian Adaptor">1. Pembelian Adaptor</option>
                                      <option value="Pembelian Baterai">2. Pembelian Baterai</option>
                                      <option value="Pembelian Sparepart">3. Pembelian Sparepart</option>
                                      <option value="Servis">4. Servis</option>
                                      <option value="Lainnya">5. Lainnya</option>
                                    </select>
                                  </div>

                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Ubah</button>
                                    <a href="hapus-pengeluaran.php?id_pengeluaran=<?= $row['id_pengeluaran']; ?>" Onclick="confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger">Hapus</a>
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
                              <h4 class="modal-title">Tambah Pengeluaran</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- body modal -->
                            <form action="tambah-pengeluaran.php" method="get">
                              <div class="modal-body">
                                Tanggal :
                                <input type="date" class="form-control" name="tgl_pengeluaran">
                                Jumlah :
                                <input type="number" class="form-control" name="jumlah">
                                Sumber :
                                <select class="form-control" name="nama_sumber">
                                  <option value="Pembelian Adaptor">1. Pembelian Adaptor</option>
                                  <option value="Pembelian Baterai">2. Pembelian Baterai</option>
                                  <option value="Pembelian Sparepart">3. Pembelian Sparepart</option>
                                  <option value="Servis">4. Servis</option>
                                  <option value="Lainnya">5. Lainnya</option>
                                </select>
                              </div>
                              <!-- footer modal -->
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Tambah</button>
                            </form>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                          </div>
                        </div>

                      </div>
              </div>


            <?php
                    }
            ?>
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
                  <form method="GET" action="export/pengeluaran/export-pengeluaran-excel.php">
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
                  <form method="GET" action="export/pengeluaran/export-pengeluaran-pdf.php">
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
      $('#transaksiPengeluaran').DataTable();
    });
  </script>

</body>

</html>