<?php
require 'function.php';
require 'cek.php';
include 'head.php';
?>

<body class="sb-nav-fixed">
  <?php include 'nav.php' ?>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid" id="analisis-body">
        <div class="row" id="analisis-bar">
          <div class="container-fluid">
            <div class="row">
              <h4>Analysis</h4>
            </div>
            <div class="row">
              <div class="col"><a href="./analisis.php?obatmasuk"><button>Pemasukan Obat</button></a></div>
              <div class="col"><a href="./analisis.php?obatmasuk"><button>Pemasukan Obat</button></a></div>
              <div class="col"><a href="./analisis.php?obatmasuk"><button>Pemasukan Obat</button></a></div>
              <div class="col"><a href="./analisis.php?obatmasuk"><button>Pemasukan Obat</button></a></div>
            </div>
          </div>
        </div>
        <?php
        if (isset($_GET['obatmasuk'])) {
          ?>
          <div class="row">
            <h3>Obat Terbanyak Masuk Bulan Ini</h3>
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Merek Dagang</th>
                    <th>Jumlah Masuk</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $ambilsemuadata1 = mysqli_query($conn, "SELECT * FROM sum_of_curmonth_masuk;");
                  while ($data = mysqli_fetch_array($ambilsemuadata1)) {
                    $md = $data['merek_dagang'];
                    $qty = $data['SUM(kuantitas)'];
                    ?>
                    <tr>
                      <td>
                        <?= $md ?>
                      </td>
                      <td>
                        <?= $qty ?>
                      </td>
                    </tr>
                    <?php
                  }
                  ;
                  ?>
                </tbody>
              </table>
            </div>
            <div style="height: 20vh;"></div>
          </div>
          <?php
        }
        ?>
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


</html>