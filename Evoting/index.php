<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-VOTING</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link rel="stylesheet" href="css/bootstrap.grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center " style="margin-top:2%;">
      <div class="logo col-2">
        <img src="............." alt="gambar" style="width:100%;height:auto;" class="gambar1">
      </div>
      <div class="col-12" style="text-align: center; color:white;">
        <h2>E-VOTING</h1>
      </div>
      <div class="col-12" style="text-align: center;color:white;">
        <h4>CALON KETUA & WAKIL KETUA ........................</h2>
      </div>
    </div>
    </div>
    <div class="row">
    <div class="card col-5 mx-auto" style="width:25rem;box-shadow: 9px 10px 5px 1px rgb(61, 2, 31);">
    <div class="row">
      <div class="col-10 mx-auto" style="margin-top:5%;margin-bottom:5%;">
      <?php


if(isset($_GET['pesan'])){
    $pesan=$_GET['pesan'];
    echo '<div class="bg-danger" style="color:white;font-size:10pt;">TERDAPAT KESALAHAN DALAM INPUT DATA/DATA TIDAK DITEMUKAN!</div>';
}
?>
      <form method="post" class="row g-3" action="cek-login.php">
  <div class="col-md-12">
    <label for="username" class="form-label" >Username</label>
    <input type="text" class="form-control" id="username" name="username">
  </div>
  <div class="col-12">
    <label for="pass" class="form-label">Password</label>
    <input type="password" class="form-control" id="pass" name="password">
  </div>
  <div class="col-12">
    <button type="submit" name ="login" class="btn btn-primary" style="width:100%;margin-top:2%;">Login</button>
  </div>
</form>
    </div>
  </div>
  </div>
  </div>
</body>
</html>

