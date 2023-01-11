<?php
require 'function.php';
require 'cek.php';
include 'head.php';
?>

<body class="sb-nav-fixed">
  <?php include 'nav.php' ?>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid">
        <h1 class="mt-4">Barang Keluar</h1>
        <div class="card mb-4">
          <div class="card-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
              <i class="fa fa-plus-square"></i> Buat Transaksi Baru
            </button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Waktu</th>
                    <th>Jumlah</th>
                    <th>Nominal</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Dokter</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ambilsemuadatatransaksi = mysqli_query($conn, "SELECT * FROM `transaksi` LEFT JOIN transaksi_berpreskripsi ON transaksi.id_transaksi = transaksi_berpreskripsi.id_transaksi;");
                  while ($data = mysqli_fetch_array($ambilsemuadatatransaksi)) {
                    $idtransaksi = $data['id_transaksi'];
                    $tanggal = $data['tanggal_transaksi'];
                    $jumlah = $data['jumlah'];
                    $nominal = $data['nominal'];
                    $pelanggan = $data['nama_pelanggan'];
                    $dokter = $data['nama_dokter'];
                    ?>
                    <tr>
                      <td>
                        <?= $idtransaksi ?>
                      </td>
                      <td>
                        <?= $tanggal ?>
                      </td>
                      <td>
                        <?= $jumlah ?>
                      </td>
                      <td>
                        <?= $nominal ?>
                      </td>
                      <td>
                        <?= $pelanggan ?>
                      </td>
                      <td>
                        <?= $dokter ?>
                      </td>
                      <td>
                        <a href="./detilkeluar.php?id=<?= $idtransaksi ?>"><button type="button"
                            class="btn btn-warning">Add Details</button></a>
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                          data-target="#delete<?= $idtransaksi ?>">Delete</button>
                      </td>
                    </tr>
                    <?php
                  }
                  ;
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
      <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
          <div class="text-muted">Copyright &copy; STEPHEN FAMILIA 2022</div>
          <div>
            <a href="#">Privacy Policy</a>
            &middot;
            <a href="#">Terms &amp; Conditions</a>
          </div>
        </div>
      </div>
    </footer>
  </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/chart-area-demo.js"></script>
  <script src="assets/demo/chart-bar-demo.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/datatables-demo.js"></script>
</body>
<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Barang Keluar</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <br>
        <form method="post">
          <?php
          $query = mysqli_query($conn, "SELECT MAX(id_transaksi) as last_id FROM transaksi;");
          $execQuery = mysqli_fetch_array($query);

          $newid = $execQuery['last_id'] + 1;
          ?>
          <label>New ID</label>
          <input type="text" name="id_t" placeholder="You Shouldn't See This" value='<?= $newid ?>' class="form-control"
            readonly>
          <br>
          <h4>Data Preskripsi (<i>opsional</i>)</h4>
          <input type="text" name="dokter" placeholder="Nama Dokter" class="form-control">
          <br>
          <input type="text" name="pasien" placeholder="Nama Pasien" class="form-control">
          <br>
          <button type="submit" class="btn btn-primary" name="buattransaksi">Submit</button>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
$ambilsemuadatatransaksi = mysqli_query($conn, "SELECT * FROM transaksi");
while ($data = mysqli_fetch_array($ambilsemuadatatransaksi)) {
  $idtransaksi = $data['id_transaksi'];
  ?>
  <!-- Delete Modal -->
  <div class="modal fade" id="delete<?= $idtransaksi; ?>">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Transaction</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <br>
          Apakah Anda Ingin Menghapus Transaksi #<?= $idtransaksi; ?> ?
          <br>
          <br>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <form method="post">
            <input type="hidden" name="idth" value="<?= $idtransaksi ?>">
            <button type="submit" class="btn btn-primary" name="hapustransaksi">Yes</button>
          </form>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

</html>