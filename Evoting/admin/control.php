<?php
session_start();

if(isset($_SESSION['login'])){
    $id=$_SESSION['userId'];
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
<?php
include("../koneksi.php");
    $sql2 = mysqli_query($konn,"SELECT * FROM users WHERE hak_akses='user' AND pilihan!='0' ");
    $jmlh2 = mysqli_num_rows($sql2);

    $sql = mysqli_query($konn,"SELECT * FROM users WHERE hak_akses='user' ");
    $jmlh = mysqli_num_rows($sql);

    $sql3 = mysqli_query($konn,"SELECT * FROM users WHERE hak_akses='admin' AND userId='$id' ");
    $query= mysqli_fetch_assoc($sql3);
    $value=$query['status'];

echo'
<div class="container mt-5">
    <form method="post">
    <div>
    <label for="voter" class="form-label">Jumlah Voter :</label>
    <input type="text" name="votter" id="voter"  class="form-control" value="'.$jmlh.' voter" style="width:100px;" disabled><br>
    <label for="voter" class="form-label">Telah Vote :</label>
    <input type="text" name="votter" class="form-control" id="voter" value="'.$jmlh2.' vote"  style="width:100px;" disabled><br>
    </div>
    <div class="mt-5">
    <label for="status">Status Vote :</label>
    <input type="text" name="votter" id="status" value="'.$value.'" disabled>
    </div>

  <table>
    <tr>
    <td>  
    <button type="submit" name="open" class="btn btn-success" >Open Vote</button>
    <button type="submit" name="close" class="btn btn-danger">Closed Vote</button>
    </td>
    </tr>
  </table>


<button type="submit" name="clear" class="btn btn-primary mt-5" style="padding:20px;font-size:24pt;">Clear Vote</button>
</div>
</form>';
            $no=0;
            $query=mysqli_query($konn, "SELECT * FROM calon");
            while($result=mysqli_fetch_array($query)){
            $total[]=$result['total'];
            $no++;
          
            }
            $maks=max($total);
            //echo $maks;

            $query2=mysqli_query($konn,"SELECT * FROM calon WHERE total='$maks' ");
            $row=mysqli_num_rows($query2);
            $sql=mysqli_fetch_assoc($query2);
            
            if($maks==0){
              $nomor='';
            }else{
              if($row>1){
                $nomor='CEK GRAFIK';
              }else{
              $nomor=$sql['nomor'];
              }
            }
    
            
            //echo $nomor;
?>

<div class="card">
  <div class="card-body">
    <h5 style="color:blue;">DATA TERTINGGI</h5>
  </div>
  <div class="card">
  <div class="card-body">
  <div class="col-2">
  <label for="total" class="form-label" style="color:#3D005F;" >TOTAL VOTE :</label>
  <input type="text" class="form-control" id="total" name="total" value="<?php echo $maks?>">
  </div>
  <div class="col-2">
  <label for="nomor" class="form-label mt-3" style="color:#3D005F;">NOMOR URUT :</label>
  <input type="text" class="form-control" id="nomor" name="nomor" value="<?php echo $nomor ?>">
  </div>
  <div class="col-2">
  <form method="POST">
  <button type="submit" name="umumkan" class="btn btn-primary mt-2"><i class="bi bi-bell"></i></button>
          </div>
  </div>
  </div>
</div>
</div>

</body>
</html><?php

if(isset($_POST['open'])){
    $sql = mysqli_query($konn,"UPDATE users SET status='open'");
    header("location:control.php");
}elseif(isset($_POST['close'])){
    $sql = mysqli_query($konn,"UPDATE users SET status='closed'");
    header("location:control.php");
}

if(isset($_POST['clear'])){
    $sql = mysqli_query($konn,"UPDATE users SET pilihan=0, status='open' ");
    $query=mysqli_query($konn,"SELECT * FROM calon");
    $jmlh=mysqli_num_rows($query);

    for($k=1;$k<=$jmlh;$k++){
    $query=mysqli_query($konn,"SELECT * FROM users WHERE pilihan='$k' ");
    $total=mysqli_num_rows($query);

    $query2=mysqli_query($konn,"UPDATE calon SET  total='$total' WHERE nomor='$k' ");
    header("location:control.php");}
}
if(isset($_POST['umumkan'])){

  if($nomor!=''){
  $sql = mysqli_query($konn,"UPDATE users SET status='closed' ");
  header("location:control.php");
}else{
  echo' <div class="bg-danger" style="color:white;font-size:10pt;">VOTING BELUM SELESAI!</div>';
}

}
}else{
    echo '<script type ="text/JavaScript">';  
      echo 'alert("KAMU HARUS LOGIN !")';  
      echo '</script>';  
  }
?>