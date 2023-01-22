<?php
session_start();
if(isset($_SESSION['login'])){
$id=$_SESSION['userId'];

include("../koneksi.php");
$query=mysqli_query($konn,"SELECT * FROM calon");
$jmlh=mysqli_num_rows($query);

for($k=1;$k<=$jmlh;$k++){
    $query=mysqli_query($konn,"SELECT * FROM users WHERE pilihan='$k' ");
    $total=mysqli_num_rows($query);

    $query2=mysqli_query($konn,"UPDATE calon SET  total='$total' WHERE nomor='$k' ");

}

?><!DOCTYPE html>
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
<li><a href="/Evoting/user/index.php">Dashboard</a></li>
  <li><a href="/Evoting/user/grafik.php">Grafik</a></li>
  <li style="float:center"><a href="/Evoting/user/profil.php"><i class="bi bi-person-fill"></i></a></li>
  <li style="float:right"><a class="active" href="../logout.php">Logout</a></li>
</ul>

<?php
$total  = mysqli_query($konn, "SELECT total FROM calon order by nomor asc");
$nama = mysqli_query($konn, "SELECT nama FROM calon order by nomor asc");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Chartjs, PHP dan MySQL Grafik Batang</title>
    <script src="js/Chart.js"></script>
    <style type="text/css">
            .container {
                width: 50%;
                margin: 15px;
            }
    </style>
  </head>
  <body>

    <div class="container">
        <canvas id="barchart" width="100" height="80"></canvas>
    </div>

  </body>
</html>

<script  type="text/javascript">
  var ctx = document.getElementById("barchart").getContext("2d");
  var data = {
            labels: [<?php while ($p = mysqli_fetch_array(
            $nama 
            )) { echo '"' . $p['nama'] . '",';}?>],
            datasets: [
            {
              label: "Jumlah Vote",
              data: [<?php while ($p = mysqli_fetch_assoc($total)) { echo '"' . $p['total'] . '",';}?>],
              backgroundColor: [
                '#29B0D0',
                '#2A516E',
                '#F07124',
                '#CBE0E3',
                '#979193'
              ]
            }
            ]
            };

  var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
            legend: {
              display: false
            },
            barValueSpacing: 10,
            scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true,
                  }
              }],
              xAxes: [{
                          gridLines: {
                              color: "rgba(0, 0, 0, 0)",
                          }
                      }]
              }
          }
        });
</script>

<?php
}else{
  echo '<script type ="text/JavaScript">';  
        echo 'alert("KAMU HARUS LOGIN !")';  
        echo '</script>';  
  }
?>
</body>
</html>