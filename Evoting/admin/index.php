<?php
session_start();

  if(isset($_SESSION['login'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color:purple;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color:#7E3192;
}
li a:hover{
    color:white;
    text-decoration:none;
}
.active {
  background-color: #04AA6D;
}
</style>
</head>
<body>
<ul>
<li><img src="........." alt="Logo" style="width:40px;margin:5%;" class="rounded-pill"></li>
  <li><a href="/Evoting/admin/index.php">Dashboard</a></li>
  <li><a href="/Evoting/admin/voter.php">Voter</a></li>
  <li><a href="/Evoting/admin/grafik.php">Grafik</a></li>
  <li><a href="/Evoting/admin/control.php">Control</a></li>
  <li style="float:center"><a href="/Evoting/admin/profil.php"><i class="bi bi-person-fill"></i></a></li>
  <li style="float:right"><a class="active" href="../logout.php">Logout</a></li>
</ul>
<div class="container">
    <div class="row">
        <div class="col-12 mx-auto mt-5">
            <h6 style="font-size:20pt;color:orange;">E-VOTING CALON KETUA & WAKIL KETUA </h3>
            <hr>
        </div>
    </div>
</div>
<?php

  include('../koneksi.php');
  
  $sql = mysqli_query($konn,"SELECT * FROM calon ");
  $jmlhcalon = mysqli_num_rows($sql);

echo'
<div class="container mx-auto">
  <div class="row">
  <div class="col-12">
<a href="edit.php?&aksi=tambah" class="btn btn-primary mb-5"><i class="bi bi-plus"></i></a>
</div>';
for($k=1;$k<=$jmlhcalon;$k++){
  $sql = mysqli_query($konn,"SELECT * FROM calon WHERE nomor='$k'");
  $query=mysqli_fetch_array($sql);

  /*$visi = $sql['visi'][$k];
  $visi = $sql['misi'][$k];
  $query = mysqli_query($konn,"SELECT * FROM calon WHERE visi='$visi', misi='$misi'");*/
echo'

    <div class="col-4">
      <div class="card bg-info" style="width: 18rem;">
          <h5 class="card-header" style="color:white;">No.'.$k.'</h5>
          <img src="../images/'.$query['foto'].'" class="card-img-top" alt="...">
        <div class="card-body bg-light">
          <p class="card-text" style="text-align:center;color:green;font-weight:bold;">VISI :'.$query['visi'].'</p>
          <p class="card-text" style="text-align:left;color:blue;font-weight:bold;">Misi :'.$query['misi'].'</p>
        </div>
        <div class="card-footer">
        <h6 style="text-align:center;color:white">'.$query['nama'].'</h6>
        </div>
        </div>
        <table>
        <tr>
        <td>
        <a href="edit.php?nomor='.$k.'&aksi=edit" class="btn btn-success"><i class="bi bi-pencil"></i></a>
        <a href="edit.php?nomor='.$k.'&aksi=hapus" class="btn btn-warning"><i class="bi bi-archive"></i></a>
        </td>
        </tr>
        </table>
    
  </div>';
}?>

</div>
    </div>
  </div>
</body>
</html>
<?php
  }else{
    echo '<script type ="text/JavaScript">';  
      echo 'alert("KAMU HARUS LOGIN !")';  
      echo '</script>';  
  }
  ?>