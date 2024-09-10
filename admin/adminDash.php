<?php 
session_start();  

if (!isset($_SESSION["email"])) {
  header("Location: ../index.php"); 
  exit();
}

$userid=$_SESSION["email"];
 if(isset($_SESSION["email"]))  
 {  
 	$dbh= new PDO("mysql:host=localhost;dbname=accident", "root", "");
  $sql="SELECT * FROM user WHERE email = ?";
  $query=$dbh->prepare($sql);
  $query->execute(array($userid));
  $results=$query->fetchAll(PDO::FETCH_OBJ);
   if($query->rowCount()>0){
    foreach ($results as $result) {
       $result->username;
       
    }
  }
  
  }  
 
// // Function to get the count of users
function getUserCount($dbh) {
  $query = "SELECT COUNT(*) AS userCount FROM user";
  $stmt = $dbh->query($query);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  return ($row) ? $row['userCount'] : 0;
}

// // Function to get the count of available books
function getVehicleCount($dbh) {
  $query = "SELECT COUNT(*) AS vehicleCount FROM vehicle ";
  $stmt = $dbh->query($query);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  return ($row) ? $row['vehicleCount'] : 0;
}

// Function to get the count of baccidents
function getaccidentCount($dbh) {
  $query = "SELECT COUNT(*) AS accidentCount FROM accident_detection ";
  $stmt = $dbh->query($query);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
  return ($row) ? $row['accidentCount'] : 0;
}

// // Example usage
$userCount = getUserCount($dbh);
$vehicleCount = getVehicleCount($dbh);
$accidentCount = getaccidentCount($dbh);
// ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo3.png" rel="icon">
  <title>RTADAS - Dashboard</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include 'sidebar.html' ?>

    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
       
        <?php include 'topbar.html' ?>

        <!-- Container Fluid-->
        <?php  include 'label.html' ?>

        <?php  include 'chartbar.php' ?>

        <!---Container Fluid-->
      </div>
      <!-- Footer -->
       <?php  include 'footer.html' ?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  
</body>

</html>

