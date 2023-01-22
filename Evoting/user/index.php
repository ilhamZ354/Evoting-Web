<?php
session_start();

if(isset($_SESSION['login'])){
    $id=$_SESSION['userId'];

    include('../koneksi.php');
$sql = mysqli_query($konn,"SELECT * FROM calon ");
$jmlhcalon = mysqli_num_rows($sql);
    

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
.card{
  transition: width 1s;
	-webkit-transition: width 1s;
}
</style>
</head>
<body>
<ul>
<li><img src="............." alt="Logo" style="width:40px;margin:5%;" class="rounded-pill"></li>
  <li><a href="/Evoting/user/index.php">Dashboard</a></li>
  <li><a href="/Evoting/user/grafik.php">Grafik</a></li>
  <li style="float:center"><a href="/Evoting/user/profil.php"><i class="bi bi-person-fill"></i></a></li>
  <li style="float:right"><a class="active" href="../logout.php">Logout</a></li>
</ul>
<div class="container">
    <div class="row">
        <div class="col-12 mx-auto mt-5">
            <h6 style="font-size:20pt;color:orange;text-align:center;">Evoting CALON KETUA & WAKIL KETUA </h3>
            <hr>
        </div>
    </div>
</div><?php
$sql2 = mysqli_query($konn,"SELECT * FROM users WHERE userId='$id' ");
$status=mysqli_fetch_assoc($sql2);


if($status['status']=='open' & $status['pilihan']==0){

echo'
<div class="container mx-auto">
<div class="row">';
for($k=1;$k<=$jmlhcalon;$k++){
$sql = mysqli_query($konn,"SELECT * FROM calon WHERE nomor='$k'");
$query=mysqli_fetch_array($sql);

/*$visi = $sql['visi'][$k];
$visi = $sql['misi'][$k];
$query = mysqli_query($konn,"SELECT * FROM calon WHERE visi='$visi', misi='$misi'");*/
echo'
  <div class="col-4">
  <form method="post"> 
    <div class="card" style="width: 18rem;">
        <h5 class="card-header bg-info" style="color:white;">No.'.$k.'</h5>
        <img src="../images/'.$query['foto'].'" class="card-img-top" alt="...">
      <div class="card-body bg-dark">
        <p class="card-text" style="text-align:center;color:white;font-weight:bold;">VISI :</p><p style="text-align:center;color:cyan;">'.$query['visi'].'</p>
        <p class="card-text" style="text-align:center;color:white;font-weight:bold;">MISI :</p><p style="text-align:center;color:cyan;">'.$query['misi'].'</p>
      </div>
      <h6 class="card-footer bg-success" style="text-align:center;color:white">'.$query['nama'].'</h6>
      <div class="col-3 mx-auto">
      <input type="hidden" name="vote" value="'.$k.'">
      <button type="submit" name="submit" class="btn btn-success">'.$k.'</button>
      </div>
      </div>
      </form>
</div>'
;

if(isset($_POST['submit'])){

    echo'
    <div class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>';
    $vote=$_POST['vote'];
    $sql = mysqli_query($konn,"UPDATE users SET pilihan='$vote',status='closed' WHERE userId='$id' ");
    header("location:index.php");
}
}
}else{
    echo'
    <div class="row">
        <div class="col-10 mx-auto">
            <h2 class="bg-primary" style="color:white;text-align:center;">TERIMA KASIH, KAMU SUDAH MEMILIH/VOTE TELAH DITUTUP</h2>
        </div>
    </div>';
}
?>

</div>
  </div>
</div>
</body>
</html>
<?php
$sql2=mysqli_query($konn,"SELECT * FROM users WHERE hak_akses='admin' ");
$row=mysqli_num_rows($sql2);


for($k=1;$k<=$row;$k++){
  $sql2=mysqli_query($konn,"SELECT * FROM users WHERE hak_akses='admin' AND userId='$k' ");
  $status2=mysqli_fetch_assoc($sql2);

}

if($status2['status']=='closed'){

echo'

    <div class="row">
    <div class="col-3 mx-auto mt-5">
            <h1 style="color:green"><i class="bi bi-check-circle-fill" style="color:green;width:100%;""></i>THE WINNER</h1>
        </div>
        </div>
        <div class="row">
        <div class="col-4 mx-auto">
            <p class="btn btn-success" style="width:100%;">SELAMAT KEPADA  CALON TERPILIH</p>
        </div>
       
    </div>'
    
    ;
$no=0;
$query=mysqli_query($konn, "SELECT * FROM calon");
while($result=mysqli_fetch_array($query)){
$total[]=$result['total'];
$no++;

}
$maks=max($total);
//echo $maks;

$query2=mysqli_query($konn,"SELECT * FROM calon WHERE total='$maks' ");
$sql=mysqli_fetch_array($query2);

if($maks==0){
  $nomor='';
}else{
  $nomor=$sql['nomor'];
}
echo '
<div class="container">
<div class="row">';

$sql = mysqli_query($konn,"SELECT * FROM calon WHERE nomor='$nomor'");
$query=mysqli_fetch_array($sql);

/*$visi = $sql['visi'][$k];
$visi = $sql['misi'][$k];
$query = mysqli_query($konn,"SELECT * FROM calon WHERE visi='$visi', misi='$misi'");*/
echo'

<div class="col-4 mx-auto">
  <div class="card" style="width:100%;">
      <h5 class="card-header bg-info" style="color:white;">No.'.$nomor.'</h5>
      <img src="../images/'.$query['foto'].'" class="card-img-top" alt="...">
    <div class="card-body bg-dark">
      <p class="card-text" style="text-align:center;color:white;font-weight:bold;">VISI :</p><p style="text-align:center;color:cyan;">'.$query['visi'].'</p>
      <p class="card-text" style="text-align:center;color:white;font-weight:bold;">MISI :</p><p style="text-align:center;color:cyan;">'.$query['misi'].'</p>
    </div>
    <h6 class="card-footer bg-success" style="text-align:center;color:white">'.$query['nama'].'</h6>
    </div>

</div>';
}

}else{
echo '<script type ="text/JavaScript">';  
      echo 'alert("KAMU HARUS LOGIN !")';  
      echo '</script>';  
}
?>