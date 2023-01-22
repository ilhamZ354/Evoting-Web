<?php
session_start();
if(isset($_SESSION['login'])){
$id=$_SESSION['userId'];

//echo $id;
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
    <div class="row">
        <div class="col-2 mx-auto">
            <img src="../images/user.jpg" alt="user" style="width:100%;">
        </div>
    <div class="container">
        <div class="row">
        <div class="col-6 mx-auto">
            <div class="card">
                <div class="card-header bg-primary mx-auto" style="width:100%;">
                    <div style="text-align:center;color:white;">Your Profile</div>
                </div>
                <?php
                include("../koneksi.php");
                $sql=mysqli_query($konn,"SELECT * FROM users WHERE userId='$id'");
                $data=mysqli_fetch_assoc($sql);

            $act='';
            if(isset($_GET['set'])){
                $act=='';
            }else{
                    $act='disabled';
                }

                echo 
                '<form method="POST">
                <div class="container" style="margin-top:5%;">
                <div class="col-12">
                <label for="username" class="form-label" >Username</label>
                <input type="text" class="form-control" id="username" name="username" value="'.$data['username'].'" '.$act.'>
                </div>
                <div class="col-12">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="'.$data['nama'].'" '.$act.'>
                </div>
                <div class="col-12">
                <label for="pass" class="form-label">Password</label>
                <input type="text" class="form-control" id="pass" name="password" value="'.$data['password'].'" '.$act.'>
                </div>
                <div class="col-2 mt-2">
                <tr>
                <td>';
                if($act!==''){
                   echo' <a href="profil.php?set=edit" class="btn btn-warning">Edit</a>';
                }else{
                    echo '<button type="submit" class="btn btn-success" name="simpan">simpan</button>';
                    }
                '</td>
                </tr>
               </div>
                </div>
                </form>
        </div>
    </div>
</div>
';
          if(isset($_POST['simpan']))  {
            $username=$_POST['username'];
            $nama=$_POST['nama'];
            $password=$_POST['password'];
            

            $sql=mysqli_query($konn,"UPDATE users SET username='$username',nama='$nama', password='$password'  WHERE userId='$id' ");
            if($sql){
                header("location:profil.php");
            }
          }

}else{
    echo '<script type ="text/JavaScript">';  
          echo 'alert("KAMU HARUS LOGIN !")';  
          echo '</script>';  
    }
?>
</body>
</html>