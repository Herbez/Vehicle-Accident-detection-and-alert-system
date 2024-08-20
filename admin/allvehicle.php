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
  <link href="img/logo/RP_Logo.jpeg" rel="icon">
  <title>LMS - Dashboard</title>
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
        
        <?php
            require('dbconn.php');
                if(isset($_POST['search']))
                    {$searchkey=$_POST['licenseplate'];
                        $sql="select * from vehicle v join owner o on o.ownerid=v.ownerid where fnames='$searchkey' or licenseplate like '%$searchkey%'";
                    }
                else
                    $sql="select * from vehicle v join owner o on o.ownerid=v.ownerid ";

                $result=$conn->query($sql);
                $rowcount=mysqli_num_rows($result);

                if (!($rowcount)) {
                    echo '<div class="container mt-3 mb-3">';
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
                    echo '<p><strong><em>Sorry, no vehicle were found.</em></strong></p>';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    echo '<span aria-hidden="true">&times;</span>';
                    echo '</button>';
                    echo '</div>';
                    echo '</div>';
                }
                
                   
                else
                {

                
                ?>

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
                    
        <!-- search for vehicle -->

        <div class="col-md-6 mt-3 mb-3">
            <form class="custom-search-form" action="" method="post">
                <div class="input-group">
                    <input type="text" name="licenseplate" class="form-control custom-search-input" placeholder="Search by license plate ..." style="border-color: #3f51b5; border-radius: 5px 0 0 5px;" required>
                    <button class="btn btn-primary custom-search-btn" name="search" type="submit" style="border-color: #3f51b5; border-radius: 0 5px 5px 0;">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </form>
        </div>

          <!-- all vehicles table   -->

          <div class="row mb-3">

            <div class="col-xl-12 col-lg-5 ">
              <div class="card">

                <div class="table-responsive">
                <table class="table align-items-center table-bordered">
                    <thead class = "text-primary">
                      <tr>
                        <th>Nationalid</th>
                        <th>Owner</th>
                        <th>License Plate</th>
                        <th>Type</th>
                        <th>GPS ID</th>
                        <th>Registered Date</th>
                      </tr>
                    </thead>
                    <tbody>

                    <?php
                            
                        //$result=$conn->query($sql);
                        while($row=$result->fetch_assoc())
                        {   
                          
                            $vehicleid=$row['vehicleid'];
                            $licplt=$row['licenseplate'];
                            $type=$row['type'];
                            $gpsid=$row['gpsmodid'];
                            $regdate=$row['regdate'];
                            $owner=$row['fnames'];
                            $nid=$row['nationalid'];              
                        ?>        

                            <tr>
                                <td><b><?php echo $nid ?></b></td>
                                <td><b><?php echo $owner ?></b></td>
                                <td><b><?php echo $licplt ?></b></td>
                                <td><b><?php echo $type ?></b></td>
                                <td><b><?php echo $gpsid ?></b></td>
                                <td><b><?php echo $regdate ?></b></td>
                            </tr>
                        <?php }} ?>

                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>

          </div>




        </div>
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