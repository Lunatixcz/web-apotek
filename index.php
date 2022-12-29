<?php
require 'function.php';
require 'cek.php';
include 'head.php';
?>
<style>
  select {
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #292929;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 6px;
    box-shadow: 0 4px 30px rgb(0 0 0 / 10%);
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  }
</style>

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
                                                <th>Unit</th>
                                                <th>Stock</th>
                                                <th>Exp Date</th>
                                                <th>Supplier</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $ambilsemuadatastock = mysqli_query($conn,"SELECT * from stock");
                                                while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                    $ambildatasupplier = mysqli_query($conn, "SELECT * FROM supplier p, stock s where s.supplier = p.idsup");
                                                    $data1 = mysqli_fetch_array($ambildatasupplier);
                                                    $idbarang = $data['idobat'];
                                                    $namabarang = $data['merek_dagang'];
                                                    $harga = $data['harga'];
                                                    $satuan = $data['satuan'];    
                                                    $stock = $data['stock'];
                                                    $exp_date = $data['exp_date'];
                                                    $supplier = $data1['nama_supplier'];
                                            ?>
                                                <tr>
                                                    <td><?=$namabarang?></td>
                                                    <td><?=$harga?></td>
                                                    <td><?=$satuan?></td>
                                                    <td><?=$stock?></td>
                                                    <td><?=$exp_date?></td>
                                                    <td><?=$supplier?></td>
                                                    <td>
                                                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idbarang;?>">Edit</button>
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
                <input type="text" name="merek_dagang" placeholder="Nama Obat" class="form-control" required>
                <br>
                <label>Harga</label>
                <input type="text" name="harga" placeholder="Harga" class="form-control" required>
                <br>
                <label>Satuan</label><br>
                <select class="form-select" id="metode" name="satuan" id = "select" class="form-control" required >
                  <option value="item">Item</option>
                  <option value="tablet">Tablet</option>
                  <option value="kapsul">Kapsul</option>
                  <option value="tetesan">Tetesan</option>
                  <option value="suppositori">Suppositori</option>
                  <option value="hirup">Hirup</option>
                </select>
                <br>
                <label>Stock</label>
                <input type="number" name="stock" placeholder="Stock" class="form-control" required>
                <br>
                <label>Exp Date</label>
                <input type="date" name="exp_date" placeholder="Exp Date" class="form-control" required>
                <br>
                <label>Supplier</label>
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
                 $idbarang = $data['idobat'];
                 $namabarang = $data['merek_dagang'];
                 $harga = $data['harga'];
                 $satuan = $data['satuan'];    
                 $stock = $data['stock'];
                 $exp_date = $data['exp_date'];
                 
        ?>
  <div class="modal fade" id="edit<?=$idbarang;?>">
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
                <input type="text" name="merek_dagang" placeholder="Nama Obat" class="form-control" value="<?=$namabarang?>">
                <br>
                <label>Harga</label>
                <input type="text" name="harga" placeholder="Harga" class="form-control" value="<?=$harga?>">
                <br>
                <label>Satuan</label><br>
                <select class="form-select" id="metode" name="satuan" id = "select">
                  <option value="item">Item</option>
                  <option value="tablet">Tablet</option>
                  <option value="kapsul">Kapsul</option>
                  <option value="tetesan">Tetesan</option>
                  <option value="suppositori">Suppositori</option>
                  <option value="hirup">Hirup</option>
                </select>
                <br>
                <label>Stock</label>
                <input type="number" name="stock" placeholder="Stock" class="form-control" value="<?=$stock?>">
                <br>
                <label>Exp Date</label>
                <input type="date" name="exp_date" placeholder="Exp Date" class="form-control" value="<?=$exp_date?>">
                <br>
                <label>Supplier</label>
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
            Apakah Anda Ingin Menghapus Item <?=$namabarang;?> ?
            <br>
            <br>
            
           
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
            <form method="post">
                <input type="hidden" name="idb" value="<?=$idbarang?>;">
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
