<?php
require 'function.php';
require 'cek.php';
include 'head.php';
?>

    <body class="sb-nav-fixed">
        <?php include 'nav.php'?>;
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Stock Obat</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus-square"></i> Tambah Obat
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama Obat</th>
                                                <th>Harga</th>
                                                <th>Satuan</th>
                                                <th>Stock</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM stock");
                                                while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                    $idbarang = $data['idbarang'];
                                                    $namabarang = $data['merek_dagang'];
                                                    $harga = $data['harga'];
                                                    $satuan = $data['satuan'];    
                                                    $stock = $data['stock'];
                                            ?>
                                                <tr>
                                                    <td><?=$namabarang?></td>
                                                    <td><?=$harga?></td>
                                                    <td><?=$satuan?></td>
                                                    <td><?=$stock?></td>
                                                    <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idbarang;?>">Edit</button>
                                                    
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idbarang;?>">Delete</button>
                                                    </td>
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
          <h4 class="modal-title">Tambah Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form method="post">
                <label>Nama Obat</label>
                <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
                <br>
                <label>Harga</label>
                <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control" required>
                <br>
                <label>Stock</label>
                <input type="number" name="stock" placeholder="Stock" class="form-control" required>
                <br>
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

        <!-- Edit Modal -->
        <?php
            $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM stock");
            while($data=mysqli_fetch_array($ambilsemuadatastock)){
                $idbarang = $data['idbarang'];
                $namabarang = $data['namabarang'];
                $deskripsi = $data['deskripsi'];
                 
        ?>
  <div class="modal fade" id="edit<?=$idbarang;?>">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Obat</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form method="post">
                <input type="hidden" name="idbaranghapus" value="<?=$idbarang?>;">
                <label>Nama Barang</label>
                <input type="text" name="namabarang" value="<?=$namabarang;?>" class="form-control" required>
                <br>
                <label>Harga</label>
                <input type="text" name="deskripsi" value="<?=$harga;?>" class="form-control" required>
                <br>
                <label></label>
                <button type="submit" class="btn btn-primary" name="updatebarang">Submit</button>
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
  <div class="modal fade" id="delete<?=$idbarang;?>">
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
            <form method="post">
                <input type="hidden" name="idb" value="<?=$idbarang?>;">
                Apakah Anda Ingin Menghapus Item <?=$namabarang;?> ?
                <br>
                <br>
                <button type="submit" class="btn btn-primary" name="hapusbarang">Yes</button>
            </form> 
           
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
            
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>
</html>
