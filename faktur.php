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
                        <h1 class="mt-4">Faktur</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus-square"></i> Tambah Faktur
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No Pembayaran</th>
                                                <th>Penjual</th>
                                                <th>Barang Pesanan</th>
                                                <th>Total Pembayaran</th>
                                                <th>Jatuh Tempo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM faktur");
                                                while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                    $id_faktur = $data['id_faktur'];
                                                    $no_pembayaran = $data['no_pembayaran'];
                                                    $penjual = $data['penjual'];
                                                    $barang_pesanan = $data['pesanan'];
                                                    $total_pembayaran = $data['total_pembayaran'];
                                                    $jatuh_tempo = $data['jatuh_tempo'];    
                                            ?>
                                                <tr>
                                                    <td><?=$no_pembayaran?></td>
                                                    <td><?=$penjual?></td>
                                                    <td><?=$barang_pesanan?></td>
                                                    <td><?=$total_pembayaran?></td>
                                                    <td><?=$jatuh_tempo?></td>
                                                    <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$id_faktur;?>">Edit</button>
                                                    
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$id_faktur;?>">Delete</button>
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
          <h4 class="modal-title">Tambah Faktur</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form method="post">
                <label>Penjual</label>
                <input type="text" name="penjual" placeholder="Penjual" class="form-control" required>
                <br>
                <label>Barang Pesanan</label>
                <input type="text" name="pesanan" placeholder="Barang Pesanan" class="form-control" required>
                <br>
                <label>Total Pembayaran</label>
                <input type="text" name="">
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
                 $idbarang = $data['idobat'];
                 $namabarang = $data['merek_dagang'];
                 $harga = $data['harga'];
                 $satuan = $data['satuan'];    
                 $stock = $data['stock'];
                 
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
</body>