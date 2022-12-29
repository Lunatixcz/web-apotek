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
                      <td><?= $md ?></td>
                      <td>
                        <?= $jlh ?>
                      </td>
                      <td><?= $harga ?></td>
                      <td>
                        <?= $total ?>
                      </td>
                      <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal"
                          data-target="#edit<?= $idobat; ?>">Edit</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                          data-target="#delete<?= $idobat; ?>">Delete</button>
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
            $pilihanbarang = mysqli_query($conn, "select * from stock");
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
          <input type="hidden" name="id_tr" value="<?= $idtd ?>;">
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
$ambildatakeluar = mysqli_query($conn, "SELECT * FROM keluar WHERE id_transaksi = '$idtd'");
while ($data = mysqli_fetch_array($ambildatakeluar)) {

  ?>
  <div class="modal fade" id="edit<?= $idbarang; ?>">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Obat</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <br>
          <form method="post">
            <label>Nama Obat</label>
            <input type="text" name="merek_dagang" placeholder="Nama Obat" class="form-control"
              value="<?= $namabarang ?>">
            <br>
            <label>Harga</label>
            <input type="text" name="harga" placeholder="Harga" class="form-control" value="<?= $harga ?>">
            <br>
            <label>Satuan</label><br>
            <select class="form-select" id="metode" name="satuan" id="select">
              <option value="item">Item</option>
              <option value="tablet">Tablet</option>
              <option value="kapsul">Kapsul</option>
              <option value="tetesan">Tetesan</option>
              <option value="suppositori">Suppositori</option>
              <option value="hirup">Hirup</option>
            </select>
            <br>
            <label>Stock</label>
            <input type="number" name="stock" placeholder="Stock" class="form-control" value="<?= $stock ?>">
            <br>
            <label>Exp Date</label>
            <input type="date" name="exp_date" placeholder="Exp Date" class="form-control" value="<?= $exp_date ?>">
            <br>
            <label>Supplier</label>
            <select name="supplier" class="form-control">
              <?php
              $pilihansupplier = mysqli_query($conn, "select * from supplier");
              while ($fetcharray = mysqli_fetch_array($pilihansupplier)) {
                $namasupplier = $fetcharray['nama_supplier'];
                $idsup = $fetcharray['idsup'];
                ?>
                <option value="<?= $idsup; ?>">
                  <?= $namasupplier; ?>
                </option>
                <?php
              }
              ?>
            </select>
            <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
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
  <div class="modal fade" id="delete<?= $idbarang; ?>">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete Item</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <br>
          Apakah Anda Ingin Menghapus Item <?= $namabarang; ?> ?
          <br>
          <br>


        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <form method="post">
            <input type="hidden" name="idb" value="<?= $idbarang ?>;">
            <button type="submit" class="btn btn-primary" name="hapusbarang">Yes</button>
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