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
<li><img src="............." alt="Logo" style="width:40px;margin:5%;" class="rounded-pill"></li>
  <li><a href="/Evoting/admin/index.php">Dashboard</a></li>
  <li><a href="/Evoting/admin/voter.php">Voter</a></li>
  <li><a href="/Evoting/admin/grafik.php">Grafik</a></li>
  <li><a href="/Evoting/admin/control.php">Control</a></li>
  <li style="float:center"><a href="/Evoting/admin/profil.php"><i class="bi bi-person-fill"></i></a></li>
  <li style="float:right"><a class="active" href="../logout.php">Logout</a></li>
</ul>
<div class="container">
    <div class="row mx-auto">
        <div class="col-12 mx-auto" style="width:100%;">
            <h6 style="font-size:20pt;margin-top:5%;">DATA VOTER E-VOTING</h3>
        </div>
    </div>
</div>
<?php
    include('../koneksi.php');

    $sql = mysqli_query($konn,"SELECT * FROM users WHERE hak_akses='user'");
    $jmlh = mysqli_num_rows($sql);

?>
<div class="container">
<table class="table">
  <thead>
    <tr>
      <th scope="col">Username</th>
      <th scope="col">Nama</th>
      <th scope="col">Vote</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  foreach($sql as $data){
    
    echo "
    <tr>
      <td>".$data['username']."</td>
      <td>".$data['nama']."</td>
      <td>";
      if($data['pilihan']==0){
        echo '<div class="btn btn-dark">Belum Vote</div>';
      }else{
        echo '<div class="btn btn-success">Sudah Vote</div>';
      }
      "</td>
    </tr>";
    }
    ?>
  </tbody>
</table>
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