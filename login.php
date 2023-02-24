<?php

 $error=false;
 $login=false;
 $erro2=false;
 if($_SERVER["REQUEST_METHOD"]=="POST"){
 include"parts/conn.php";
 $username=$_POST['username'];
  $password=$_POST['password'];
 
 // $sql="SELECT * FROM `users` WHERE username='$username' AND password='$password'";
 $sql="SELECT * FROM `users` WHERE USERNAME='$username'";
 $result=mysqli_query($con,$sql);
  $num=mysqli_num_rows($result);

 if($num==1){
       while($row=mysqli_fetch_assoc($result)){
          if(password_verify($password,$row['PASSWORD'])){
            $login=true;
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['username']=$username;
            header("location:index.php"); 
          }
          else{
            $erro2=true;
            }
          }

       }
       else{
         $error=true;
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

    <title>login</title>
  </head>
  <body>
    <?php
   require'parts/_nav.php';
   if($login){
   echo '
   <div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong>success!!</strong> You are logedin.. 
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';}

if($error){
     echo '
     <div class="alert alert-danger alert-dismissible fade show" role="alert">
       <strong>Error!!</strong> Invalid username...
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';}
  if($erro2){
    echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!!</strong> Invalid password...
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
 </div>';}

     ?>




<div class="container">
     <h1 class="text-center">login to our website </h1>
     <form action="/loginsys/login.php" method="post">
  <div class="mb-3">
    <label for="username" class="form-label">User Name </label>
    <input type="text" required class="form-control" id="username" name="username" aria-describedby="" >
</div>
<div class="mb-3">
     <label for="Password" class="form-label">Password</label>
     <input type="password" class="form-control" id="password" name="password" required>
</div>

  
  <button type="submit" class="btn btn-primary">login</button>
</form>

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