<?php 
session_start();  
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



 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo2.jpeg" rel="icon">
  <title>VCDAS - Dashboard</title>
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
        <?php include'topbar.html' ?>

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">

        <!-- Form Basic -->
        
    <form name="addbookForm" action="" method="POST" >
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Register Vehicle Owner</h6>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label text-right">National ID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name = "nid" placeholder="National ID" style="width: 600px;">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label text-right">Full Names</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name = "fnames" placeholder="Full Names" style="width: 600px;">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label text-right">Phone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name = "phone" placeholder="phone" style="width: 600px;">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label text-right">Family Phone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name = "famphone" placeholder="Family Member Phone" style="width: 600px;">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-right">Address</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="address" style="width: 600px;">
                                <option disabled selected>Select Address</option>
                                <option >Kigali</option>
                                <option >Musanze</option>
                                <option >Rubavu</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <button type="submit" name="addowner" class="btn btn-primary">Register Owner</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </form>

        <!-- Form Basic -->
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <?php include 'footer.html' ?>
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

<?php
require('dbconn.php');

if(isset($_POST['addowner']))
  {
    $nid=$_POST['nid'];
    $fnames=$_POST['fnames'];
    $phone=$_POST['phone'];
    $famphone=$_POST['famphone'];
    $address=$_POST['address'];

    $sql="INSERT INTO owner (nationalid,fnames,phone,familyphone,address) VALUES ('$nid','$fnames','$phone','$famphone','$address')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script type='text/javascript'>alert('owner Added Successful')</script>";
        
      } else {
        echo "<script type='text/javascript'>alert('owner Not Added')</script>";
        
      }
  }
?>