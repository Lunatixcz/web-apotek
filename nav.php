<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">
    <img style="margin-top:-3px;margin-right:20px;width: 40px;height: 40px;" src="assets/img/pharicon.png" alt="Logo">
    <span style="font-size:20px;font-weight:bold;">Apotek</span></a>
  <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
      class="fas fa-bars"></i></button>
  <!-- Navbar Search-->
  <!-- <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    <div class="input-group">
      <input class="form-control" type="text" placeholder="Search for..." aria-label="Search"
        aria-describedby="basic-addon2" />
      <div class="input-group-append">
        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
      </div>
    </div>
  </form> -->
  <!-- Navbar-->
  <ul class="navbar-nav ml-auto ml-md-0" style="position: absolute; right: 0.75rem;">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="logout.php"><i class="fa-regular fa-user"></i>
          <?php echo $_SESSION['name']; ?>
        </a>
        <p class="dropdown-item"><?= $_SESSION['akses'] ?></p>
        <a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
      </div>
    </li>
  </ul>
</nav>
<div id="layoutSidenav">
  <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
      <div class="sb-sidenav-menu">
        <div class="nav">
          <div class="sb-sidenav-menu-heading">Menu</div>
          <a class="nav-link" href="index.php">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-box"></i></div>
            Stock Obat
          </a>
          <a class="nav-link" href="masuk.php">
            <div class="sb-nav-link-icon"><i class="fa fa-plus-square"></i></div>
            Obat Masuk
          </a>
          <a class="nav-link" href="keluar.php">
            <div class="sb-nav-link-icon"><i class="fas fa-list-ul"></i></div>
            Transaksi
          </a>

          <a class="nav-link" href="supplier.php">
            <div class="sb-nav-link-icon"><i class="fas fa-user-circle"></i></div>
            Supplier
          </a>

          <a class="nav-link" href="faktur.php">
            <div class="sb-nav-link-icon"><i class="fas fa-file-contract"></i></div>
            Faktur
          </a>

          <a class="nav-link" href="analisis.php">
            <div class="sb-nav-link-icon"><i class="fas fa-line-chart"></i></div>
            Analisis
          </a>

          <a class="nav-link" href="logout.php">
            <div class="sb-nav-link-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
            Logout
          </a>
    </nav>
  </div>