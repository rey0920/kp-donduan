<?php
require 'cek-sesi.php';
include 'head.php';
?>

<body id="page-top">

  <?php
  require 'koneksi.php';
  require 'sidebar.php'; ?>

  <!-- Main Content -->
  <div id="content">

    <?php require 'navbar.php'; ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <div class="mb-4">
        <h6 class="mb-0 text-gray-600">Keuangan / <span class="text-gray-700 font-weight-bold">Laporan</span></h6>
      </div>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Laporan Keuangan</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Jumlah Transaksi </th>
                  <th>Jumlah Total Uang</th>
                  <th>Download</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $pemasukan = mysqli_query($koneksi, "SELECT * FROM pemasukan");
                while ($masuk = mysqli_fetch_array($pemasukan)) {
                  $arraymasuk[] = $masuk['jumlah'];
                }
                $jumlahmasuk = array_sum($arraymasuk);

                $pengeluaran = mysqli_query($koneksi, "SELECT * FROM pengeluaran");
                while ($keluar = mysqli_fetch_array($pengeluaran)) {
                  $arraykeluar[] = $keluar['jumlah'];
                }
                $jumlahkeluar = array_sum($arraykeluar);

                $query1 = mysqli_query($koneksi, "SELECT id_pemasukan FROM pemasukan");
                $query1 = mysqli_num_rows($query1);

                $query2 = mysqli_query($koneksi, "SELECT id_pengeluaran FROM pengeluaran");
                $query2 = mysqli_num_rows($query2);
                $no = 1;
                ?>
                <tr>
                  <td>Pemasukan</td>
                  <td><?= $query1 ?></td>
                  <td>Rp. <?= number_format($jumlahmasuk, 0, ',', '.'); ?></td>
                  <td>
                    <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#laporan"><i class="fas fa-download fa-sm text-white"></i></button>
                  </td>
                </tr>

                <tr>
                  <td>Pengeluaran</td>
                  <td><?= $query2 ?></td>
                  <td>Rp. <?= number_format($jumlahkeluar, 0, ',', '.'); ?></td>
                  <td>
                    <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#laporan1"><i class="fas fa-download fa-sm text-white"></i></button>
                  </td>
                </tr>
              </tbody>

              <p>Admin sedang login : <?= $_SESSION['nama'] ?></p> <br>
              <p>Waktu : <?php echo date('l, d-m-Y  h:i:s a'); ?></p>
            </table>
          </div>

          <!-- Modal Pemasukan -->
          <!-- Modal laporan -->
          <div class="modal fade" id="laporan">
            <div class="modal-dialog">
              <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Download Laporan Pemasukan</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body d-flex justify-content-center">
                  <a href="export/pendapatan/sendiri-excel.php" class="btn btn-success mx-2"><i class="fas fa-download fa-sm text-white-50"></i> Excel</a>

                  <a href="export/pendapatan/sendiri-pdf.php" class="btn btn-primary mx-2"><i class="fas fa-download fa-sm text-white-50"></i> PDF</a>
                </div>
              </div>
            </div>
          </div>
          <!-- End Modal Pemasukan -->

          <!-- Modal Pengeluaran -->
          <!-- Modal laporan -->
          <div class="modal fade" id="laporan1">
            <div class="modal-dialog">
              <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Download Laporan Pengeluaran</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body d-flex justify-content-center">
                  <a href="export/pengeluaran/sendiri-excel.php" class="btn btn-success mx-2"><i class="fas fa-download fa-sm text-white-50"></i> Excel</a>

                  <a href="export/pengeluaran/sendiri-pdf.php" class="btn btn-primary mx-2"><i class="fas fa-download fa-sm text-white-50"></i> PDF</a>
                </div>
              </div>
            </div>
          </div>
          <!-- End Modal Pengeluaran -->
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
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>