<?php
require 'function.php';
require 'cek.php';
include 'head.php';

if (!isset($_GET['id'])) {
  header('location: keluar.php');
} else {
  $idtd = $_GET['id'];
}
?>
<style>
  .new-message {
    padding: 2vh 1vw;
    margin-top: 2vh;
    background-color: #ffdee8;
    border-radius: 0.8vh;
    border: 1px solid #ff5488;
    color: red;
  }
</style>

<body class="sb-nav-fixed">
  <?php include 'nav.php' ?>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid">
        <?php
        if (isset($_GET['msg'])) {
          $msg = $_GET['msg'];
          echo
            "
        <div class='new-message'>
          $msg
        </div>
        ";
        }
        ?>
        <h1 class="mt-4">Detil Transaksi #<?= $idtd ?></h1>
        <div class="card mb-4">
          <div class="card-header">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
              <i class="fa fa-plus-square"></i> Tambah Barang
            </button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Merek Dagang</th>
                    <th>Jumlah</th>
                    <th>Harga/Barang</th>
                    <th>Harga Total</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  $ambilsemuadatastock = mysqli_query($conn, "SELECT keluar.id_obat, stock.merek_dagang, keluar.jumlah, stock.harga, keluar.jumlah * stock.harga as total FROM keluar INNER JOIN stock ON keluar.id_obat = stock.idobat WHERE id_transaksi = '$idtd';");
                  while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                    $idobat = $data['id_obat'];
                    $md = $data['merek_dagang'];
                    $jlh = $data['jumlah'];
                    $harga = $data['harga'];
                    $total = $data['total'];
                    ?>
                    <tr>
                      <td>
                        <?= $md ?>
                      </td>
                      <td>
                        <?= $jlh ?>
                      </td>
                      <td>
                        <?= $harga ?>
                      </td>
                      <td>
                        <?= $total ?>
                      </td>
                      <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal"
                          data-target="#edit<?= $idobat ?>">Edit</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                          data-target="#delete<?= $idobat ?>">Delete</button>
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
        <h4 class="modal-title">Tambah Barang</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <br>
        <form method="post">
          <select name="idobatbaru" class="form-control">
            <?php
            $pilihanbarang = mysqli_query($conn, "SELECT stock.idobat, stock.merek_dagang FROM stock WHERE stock.idobat NOT IN (SELECT keluar.id_obat FROM keluar WHERE keluar.id_transaksi = '$idtd');");
            while ($fetcharray = mysqli_fetch_array($pilihanbarang)) {
              $namabarang = $fetcharray['merek_dagang'];
              $idbarang = $fetcharray['idobat'];

              ?>
              <option value="<?= $idbarang; ?>">
                <?= $namabarang; ?>
              </option>
              <?php
            }
            ?>
          </select>
          <input type="hidden" name="id_tr" value="<?= $idtd ?>">
          <br>
          <input type="number" name="qtybaru" placeholder="Quantity" class="form-control" required>
          <br>
          <button type="submit" class="btn btn-primary" name="transaksitambah">Submit</button>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Edit Modal -->
<?php
$ambildatakeluar = mysqli_query($conn, "SELECT stock.idobat, stock.merek_dagang, stock.stock, keluar.jumlah FROM stock JOIN keluar ON keluar.id_obat = stock.idobat WHERE keluar.id_transaksi = '$idtd';");
while ($data = mysqli_fetch_array($ambildatakeluar)) {
  $t_id_obat = $data['idobat'];
  $t_merek = $data['merek_dagang'];
  $t_stock = $data['stock'];
  $o_stock = $data['jumlah'];
  $m_stock = $t_stock + $o_stock;
  ?>
  <div class="modal fade" id="edit<?= $t_id_obat ?>">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">
            <?= $t_merek ?>
          </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <br>
          <form method="post">
            <input type="hidden" name="id_obat_detil" value="<?= $t_id_obat ?>" />
            <input type="hidden" name="id_sori_detil" value="<?= $m_stock ?>" />
            <input type="hidden" name="id_sb_detil" value="<?= $t_stock ?>" />
            <input type="hidden" name="id_trans_detil" value="<?= $idtd ?>" />
            <label>
              <?= $t_stock ?> obat tersisa
            </label>
            <input type="number" name="stock_detil" class="form-control" value="<?= $o_stock ?>">
            <br>
            <button type="submit" class="btn btn-primary" name="aturdetilobat">Submit</button>
          </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Modal -->
  <div class="modal fade" id="delete<?= $t_id_obat; ?>">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete <?= $t_merek ?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <br>
          Apakah Anda Ingin Menghapus Item <?= $t_merek; ?> ?
          <br>
          <br>


        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <form method="post">
            <input type="hidden" name="id_t_del" value="<?= $idtd ?>">
            <input type="hidden" name="id_o_del" value="<?= $t_id_obat ?>">
            <button type="submit" class="btn btn-primary" name="hapustobat">Yes</button>
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