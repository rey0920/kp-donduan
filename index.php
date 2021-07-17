<?php
error_reporting(0);
require 'cek-sesi.php';
include 'head.php';
?>

<body id="page-top">

  <?php
  require('koneksi.php');
  require('sidebar.php');

  // Data keseluruhan pengeluaran hari ini
  $pengeluaran_hari_ini = mysqli_query($koneksi, "SELECT jumlah FROM pengeluaran where tgl_pengeluaran = CURDATE()");
  while ($keluar_hari_ini = mysqli_fetch_array($pengeluaran_hari_ini)) {
    $akeluar_hari_ini[] = $keluar_hari_ini['jumlah'];
  }
  $jumlah_keluar_hari = array_sum($akeluar_hari_ini);

  // Data keseluruhan pemasukan hari ini
  $pemasukan_hari_ini = mysqli_query($koneksi, "SELECT jumlah FROM pemasukan where tgl_pemasukan = CURDATE()");
  while ($masuk_hari_ini = mysqli_fetch_array($pemasukan_hari_ini)) {
    $amasuk_hari_ini[] = $masuk_hari_ini['jumlah'];
  }
  $jumlah_masuk_hari = array_sum($amasuk_hari_ini);

  // Data keseluruhan pemasukan
  $pemasukan = mysqli_query($koneksi, "SELECT * FROM pemasukan");
  while ($masuk = mysqli_fetch_array($pemasukan)) {
    $arraymasuk[] = $masuk['jumlah'];
  }
  $jumlahmasuk = array_sum($arraymasuk);

  // Data keseluruhan pengeluaran
  $pengeluaran = mysqli_query($koneksi, "SELECT * FROM pengeluaran");
  while ($keluar = mysqli_fetch_array($pengeluaran)) {
    $arraykeluar[] = $keluar['jumlah'];
  }
  $jumlahkeluar = array_sum($arraykeluar);
  // Kalkulasi
  $uang = $jumlahmasuk - $jumlahkeluar;

  // Data total keseluruhan barang
  $stokquery = mysqli_query($koneksi, "SELECT id FROM barang");
  $stokquery = mysqli_num_rows($stokquery);

  // Data total transaksi keluar barang
  $keluarquery = mysqli_query($koneksi, "SELECT nomor FROM barang_keluar");
  $keluarquery = mysqli_num_rows($keluarquery);
  ?>
  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>

      <?php require 'user.php'; ?>

    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#laporan"><i class="fas fa-download fa-sm text-white-50"></i> Download Laporan</button>
      </div>

      <!-- Content Row -->
      <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-9 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pendapatan (Hari Ini)</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.<?= number_format($jumlah_masuk_hari, 0, ',', '.'); ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-9 mb-4">
          <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pengeluaran (Hari Ini)</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.<?= number_format($jumlah_keluar_hari, 0, ',', '.'); ?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-9 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Sisa Uang</div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Rp.<?= number_format($uang, 0, ',', '.'); ?></div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
              </div>

            </div>

          </div>
        </div>

        <div class="col-xl-6 col-md-9 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Barang</div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $stokquery ?> Item</div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
              </div>

            </div>

          </div>
        </div>

        <div class="col-xl-6 col-md-9 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Transaksi Barang Keluar</div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $keluarquery ?></div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
              </div>

            </div>

          </div>
        </div>

        <!-- Modal laporan -->
        <div class="modal fade" id="laporan">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Download Laporan Keseluruhan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <!-- Modal body -->
              <div class="modal-body d-flex justify-content-center">
                <a href="export/semua/export-semua-excel.php" class="btn btn-success mx-2"><i class="fas fa-download fa-sm text-white-50"></i> Excel</a>

                <a href="export/semua/export-semua-pdf.php" class="btn btn-primary mx-2"><i class="fas fa-download fa-sm text-white-50"></i> PDF</a>
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

  <?php require 'logout-modal.php'; ?>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="assets/vendor/chart.js/Chart.min.js"></script>

</body>

</html>