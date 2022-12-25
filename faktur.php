<?php
require 'function.php';
require 'cek.php';
include 'head.php';
?>
<style>
  #pesanan {
    height: 250px;
  }
</style>
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
                                                <th>Tanggal Pemesanan</th>
                                                <th>Penjual</th>
                                                <th>Barang Pesanan</th>
                                                <th>Total Pembayaran</th>
                                                <th>Jatuh Tempo</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM faktur");
                                                while($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                    $id_faktur = $data['id_faktur'];
                                                    $tanggal_pemesanan = $data['tanggal'];
                                                    $penjual = $data['penjual'];
                                                    $barang_pesanan = $data['pesanan'];
                                                    $total_pembayaran = $data['total_pembayaran'];
                                                    $jatuh_tempo = $data['jatuh_tempo'];    
                                            ?>
                                                <tr>
                                                    <td><?=$tanggal_pemesanan?></td>
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
                <label>Tanggal Pemesanan</label>
                <input type="date" name="tanggalpesan" placeholder="Tanggal Pemesanan" class="form-control" required>
                <br>
                <label>Penjual</label>
                <input type="text" name="penjual" placeholder="Penjual" class="form-control" required>
                <br>
                <label>Barang Pesanan</label><br>
                <textarea name="pesanan" id="pesanan" class="form-control"></textarea>
                <br>
                <label>Total Pembayaran</label>
                <input type="text" name="totalpesanan" placeholder="Total Pembayaran" class="form-control" required>
                <br>
                <label>Jatuh Tempo</label>
                <input type="date" name="jatuhtempo" placeholder="Jatuh Tempo" class="form-control" required>
                <br>
                <button type="submit" class="btn btn-primary" name="addnewfaktur">Submit</button>
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
             $ambilsemuadatastock = mysqli_query($conn,"SELECT * FROM faktur");
             while($data=mysqli_fetch_array($ambilsemuadatastock)){
                 $id_faktur = $data['id_faktur'];
                 $tanggal_pemesanan = $data['tanggal'];
                 $penjual = $data['penjual'];
                 $barang_pesanan = $data['pesanan'];
                 $total_pembayaran = $data['total_pembayaran'];
                 $jatuh_tempo = $data['jatuh_tempo'];    
                 
        ?>
  <div class="modal fade" id="edit<?=$id_faktur;?>">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Faktur</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <br>
            <form method="post">
            <input type="hidden" name="id_faktur" value="<?=$id_faktur?>;">
            <label>Tanggal Pemesanan</label>
                <input type="date" name="tanggalpesan" placeholder="Tanggal Pemesanan" class="form-control" value="<?=$tanggal_pemesanan?>" required>
                <br>
                <label>Penjual</label>
                <input type="text" name="penjual" placeholder="Penjual" class="form-control" value="<?=$penjual?>" required>
                <br>
                <label>Barang Pesanan</label><br>
                <textarea name="pesanan" id="pesanan" class="form-control "value="<?=$barang_pesanan?>"></textarea>
                <br>
                <label>Total Pembayaran</label>
                <input type="text" name="totalpesanan" placeholder="Total Pembayaran" class="form-control" value="<?=$total_pembayaran?>" required>
                <br>
                <label>Jatuh Tempo</label>
                <input type="date" name="jatuhtempo" placeholder="Jatuh Tempo" class="form-control" value="<?=$jatuh_tempo?>" required>
                <br>
                <button type="submit" class="btn btn-primary" name="idupfaktur">Submit</button>
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
  <div class="modal fade" id="delete<?=$id_faktur;?>">
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
                Apakah Anda Ingin Menghapus Item?
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <form method="post">
              <input type="hidden" name="id_faktur" value="<?=$id_faktur?>;">
              <button type="submit" class="btn btn-primary" name="hapusfaktur">Yes</button>
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
</body>