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
        <h6 class="mb-0 text-gray-600">Data / <span class="text-gray-700 font-weight-bold">Pegawai</span></h6>
      </div>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <div class="d-flex justify-content-between">
            <h6 class="font-weight-bold text-primary mt-3">Data Pegawai</h6>
            <button type="button" class="btn btn-success px-3 -py-3 btn-sm" data-toggle="modal" data-target="#myModalTambah"><i class="fa fa-plus"></i> <b>Pegawai</b></button>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Email </th>
                  <th>Jabatan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tfoot>
              </tfoot>
              <tbody>
                <?php
                $query_edit = mysqli_query($koneksi, "SELECT * FROM admin");
                while ($row = mysqli_fetch_array($query_edit)) {
                  if ($row['level'] == "pegawai") {
                ?>

                    <tr>
                      <td><?php echo $row['nama']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo $row['level']; ?></td>
                      <td><a href="#" type="button" class=" fa fa-edit btn btn-primary btn-md" data-toggle="modal" data-target="#myModal<?php echo $row['id_admin']; ?>"></a></td>
                    </tr>
                    <div class="modal fade" id="myModal<?php echo $row['id_admin']; ?>" role="dialog">

                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Ubah Data Pegawai</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <form role="form" action="proses-edit-pegawai.php" method="get">

                            <?php
                            $id = $row['id_admin'];
                          }
                        }
                        $query_edit = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin='$id'");
                        //$result = mysqli_query($conn, $query);
                        while ($data = mysqli_fetch_array($query_edit)) {
                            ?>


                            <input type="hidden" name="id_admin" value="<?php echo $data['id_admin']; ?>">

                            <div class="form-group">
                              <label>Nama</label>
                              <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>">
                            </div>

                            <div class="form-group">
                              <label>Email</label>
                              <input type="text" name="email" class="form-control" value="<?php echo $data['email']; ?>">
                            </div>

                            <div class="form-group">
                              <label>Password</label>
                              <input type="password" name="pass" class="form-control" value="<?php echo $data['pass']; ?>">
                            </div>

                            <div class="form-group">
                              <label>Jabatan</label>
                              <select name="level" id="level" class="form-control">
                                <option value="pegawai">Pegawai</option>
                                <option value="admin">Admin</option>

                              </select>
                            </div>


                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success">Ubah</button>
                              <a href="hapus-pegawai.php?id=<?= $data['id_admin']; ?>" Onclick="confirm('Anda Yakin Ingin Menghapus?')" class="btn btn-danger">Hapus</a>
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


              </tbody>
            </table>
          </div>
        </div>
      </div>

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
            <form action="tambah-pegawai.php" method="get">
              <div class="modal-body">

                Nama
                <input type="text" class="form-control" name="nama">
                Email :
                <input type="email" class="form-control" name="email">
                Password:
                <input type="password" class="form-control" name="pass">

                Jabatan :
                <select name="level" id="level" class="form-control">
                  <option value="pegawai">Pegawai</option>
                  <option value="admin">Admin</option>

                </select>


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