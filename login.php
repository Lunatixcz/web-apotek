<?php
include 'function.php';
//cek login terdaftar apa tidak
if (isset($_POST['login'])) {
  $nama = $_POST['nama'];
  $password = $_POST['password'];

  //cek database
  $cekdatabase = mysqli_query($conn, "Select * from login where email='$nama' and password='$password'");
  //hitung jumlah data
  $hitung = mysqli_num_rows($cekdatabase);
  if ($hitung > 0) {
    session_start();
    while ($data = mysqli_fetch_array($cekdatabase)) {
      $_SESSION['name'] = $data['email'];
    }
    $_SESSION['log'] = 'True';
    header('location:index.php');
  } else {
    header('location:login.php');
  }
  ;

}
;

if (!isset($_SESSION['log'])) {

} else {
  $_SESSION['nama'] = $cekdatabase['email'];
  header('location:index.php');
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>STEPHEN FAMILIA</title>
  <link href="assets/img/favicon.png" rel="icon" />
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/5475682f31.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container" style="margin-top: 65px;">
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5" id="login-card">
                <div class="card-header">
                  <h3 class="text-center font-weight-light my-4">Login</h3>
                </div>
                <div class="card-body">
                  <form method="post">
                    <div class="form-group">
                      <label class="small mb-1" for="inputEmailAddress">Nama</label>
                      <input class="form-control py-4" name="nama" id="inputEmailAddress" type="email"
                        placeholder="Enter email address" />
                    </div>
                    <div class="form-group">
                      <label class="small mb-1" for="inputPassword">Password</label>
                      <input class="form-control py-4" name="password" id="inputPassword" type="password"
                        placeholder="Enter password" />
                    </div>
                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                      <button class="btn btn-primary" name="login">Login</button>
                    </div>
                  </form>
                  <a href="register.php">Register</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
</body>

</html>