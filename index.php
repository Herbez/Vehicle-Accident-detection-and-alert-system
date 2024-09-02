<?php  
 session_start();   
 $message = "";  
 try  
 {   
      $dbh= new PDO("mysql:host=localhost;dbname=accident", "root", "");
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
      if(isset($_POST["signin"]))  
      {  
           if(empty($_POST["email"]) || empty($_POST["password"]))  
           {  
                $message = 'Email and Password are required!';  
           }  
           else  
           {  
                $query = "SELECT * FROM user WHERE email = :email AND password = :password";  
                $statement = $dbh->prepare($query);  
                $statement->execute(  
                     array(  
                          'email'     =>     $_POST["email"],  
                          'password'     =>     $_POST["password"]  
                     )  
                );  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                  $user = $statement->fetch(PDO::FETCH_ASSOC);
                  $_SESSION["email"]=$_POST['email'] ;

                  if ($user['type'] == 1) {    
                    header("location:admin/adminDash.php");
                  } else {
                     header("location:member/memberDash.php");
                  }     
                }  
                else   
                {  
                     $message = 'Invalid Email or Password ';  
                }  
           }  
      }  
 }  
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  
 ?> 


<!DOCTYPE html>
<html lang="en">  
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="styles.css">
  <link href="img/logo3.png" rel="icon">
  <title>RTADAS - LOGIN</title>
</head>
<body style="background:#6495ED"> 

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: absolute; top: 0; width: 100%; z-index: 1000;">
    <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="img/logo2.jpeg" alt="VCDAS Logo" style="height: 40px; margin-right: 10px;">
        <span style="font-weight: bold; font-family: Arial, sans-serif; font-size: 22px;">
        ROAD TRAFFIC POLICE</span>

    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#" style="color:black;">Sign Up 
                  <i class="fas fa-sign-in-alt"></i></a>
            </li>
        </ul>
    </div> -->
</nav>


  <div class="login-container" style="margin-top: 40px;max-width: 350px;padding: 30px;" >
      <header>
          <h3 class="text-center" style="margin-bottom: 30px;  font-family: Arial, sans-serif; font-size: 26px;">
          LOGIN FORM</h3>
        </header>
        <small class="text-danger"> <?php  echo $message; ?> 
        </small>       
          
    <form method="POST" action="">
      <div class="form-group">
        <label for="inputEmail" style=" font-size: 16px;">
          Email:</label>
        <input type="email" class="form-control" name="email" placeholder="Enter your email" >
        
      </div>
      
      <div class="form-group">
        <label for="inputPassword" style=" font-size: 16px;">Password:</label>
        <input type="password" class="form-control memberEmail" name="password" placeholder="Enter your password" >
        
      </div>

      
      <button type="submit"  name="signin" class="btn btn-primary mb-6 BtnLogin" >Login </button>
    </form>
    <!-- <div class="sign-up mt-3">
    Don't have an account? <a href="signup.php">Create Account</a>
    </div> -->
    <div class="forgot-password mt-3" style=" font-size: 16px;">
      <a href="#">Forgot Password?</a>
    </div>
  </div>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>


