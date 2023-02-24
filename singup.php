<?php
$error=false;
$showalert=false;
$error2=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
 include"parts/conn.php";
 $username=$_POST['username'];
 $password=$_POST['password'];
 $cpassword=$_POST['cpassword'];
 
$exist=false;
 
 $existsql="SELECT * FROM `users` WHERE username='$username'";
 $res=mysqli_query($con,$existsql);
 $numx=mysqli_num_rows($res);
 if($numx!=0)
 {
  $exist=true;
  $error2=true;
 }
 elseif($password!=$cpassword){
  $error=true;
 }

 else{
  $hash=password_hash($password,PASSWORD_DEFAULT);
  $sql="INSERT INTO `users` ( `USERNAME`, `PASSWORD`, `DT`) VALUES ('$username', '$hash', current_timestamp())";
 $result=mysqli_query($con,$sql);
  if($result){
  $showalert=true;
  }
 }

      
}
     ?>




<!doctype html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-7mQhpDl5nRA5nY9lr8F1st2NbIly/8WqhjTp+0oFxEA/QUuvlbF6M1KXezGBh3Nb" crossorigin="anonymous">

    <title>Signup</title>
  </head>
  <body>
    <?php
   require'parts/_nav.php';
   if($showalert){
   echo '
   <div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong>success!!</strong> You are signup and you can login now. 
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';}

if($error){
     echo '
     <div class="alert alert-danger alert-dismissible fade show" role="alert">
       <strong>Error!!</strong> password do not match .....
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';}
if($error2){
    echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!!</strong> User name already exists .....
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>';}
     ?>




    <div class="container">
     <h1 class="text-center">signup to our website </h1>
     <form action="/loginsys/singup.php" method="post">
  <div class="mb-3">
    <label for="username" class="form-label">User Name </label>
    <input type="text" class="form-control" maxlength ="25" id="username" name="username" aria-describedby="" required>
</div>
<div class="mb-3">
     <label for="Password" class="form-label" maxlength="25">Password</label>
     <input type="password" class="form-control" id="password" name="password" required>
</div>
<div class="mb-3">
     <label for="cPassword" class="form-label">Confirm Password</label>
     <input type="password" class="form-control" id="cpassword" name="cpassword" required>
     <div id="emailHelp" class="form-text">Please type the same password </div>
  </div>
  <span>

    <button type="submit" class="btn btn-primary">Sign up</button> 
  </span>
  
  
</form>
<span>if you alreay have account please login</span>
<span>
<a href="/loginsys/login.php"><button class="btn btn-outline-primary ">login </button></a>

</span>


    </div>


    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    -->
  </body>
</html>