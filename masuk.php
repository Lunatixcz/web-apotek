<?php
require 'function.php';
require 'cek.php';
include 'head.php';
?>
    <body class="sb-nav-fixed">
        <?php include 'nav.php'?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Obat Masuk</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus-square"></i> Update Obat Masuk
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Nama Barang</th>
                                                <th>Supplier</th>
                                                <th>Quantity</th>
                                                <th>Nominal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                                $ambilsemuadatastock = mysqli_query($conn,"SELECT * from masuk m,supplier p, stock s where s.idobat = m.idobat and p.idsup = m.supplier");
                                                while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                    $idbarang = $data['idobat'];
                                                    $tanggal = $data['tanggal'];
                                                    $namabarang = $data['merek_dagang'];
                                                    $supplier = $data['supplier'];
                                                    $kuantitas = $data['kuantitas'];
                                                    $besarharga = $data['besarharga'];
                                            ?>
                                                <tr>
                                                    <td><?=$tanggal?></td>
                                                    <td><?=$namabarang?></td>
                                                    <td><?=$supplier?></td>
                                                    <td><?=$kuantitas?></td>
                                                    <td><?=$besarharga?></td>
                                                </tr>

                                            <?php
                                                };
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
                            <div class="text-muted">Copyright &copy; SOPHIA 2022</div>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
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
          <h4 class="modal-title">Obat Masuk</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form method="post">
                <select name="barangnya" class="form-control">
                    <?php
                        $pilihanbarang = mysqli_query($conn,"select * from stock");
                        while($fetcharray = mysqli_fetch_array($pilihanbarang)){
                            $namabarang = $fetcharray['merek_dagang'];
                            $idbarang = $fetcharray['idobat'];
                        
                    ?>
                    <option value="<?=$idbarang;?>"><?=$namabarang;?></option>
                <?php
                    }
                ?>
                </select>
                <br>
                <input type="number" name="qty" placeholder="Quantity" class="form-control" required>
                <br>
                <select name="supplier" class="form-control">
                    <?php
                        $pilihansupplier = mysqli_query($conn,"select * from supplier");
                        while($fetcharray=mysqli_fetch_array($pilihansupplier)){
                         $namasupplier=$fetcharray['nama_supplier'];
                         $idsup=$fetcharray['idsup'];       
                    ?>
                    <option value="<?=$idsup;?>"><?=$namasupplier;?></option>        
                    <?php
                        }
                    ?>
                </select>
                <br>
                <input type="text" name="harga" placeholder="Harga" class="form-control" required>
                <br>
                <button type="submit" class="btn btn-primary" name="barangmasuk">Submit</button>
            </form> 
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
</html>
