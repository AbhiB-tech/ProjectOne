<?php

@include 'connection/connection.php';
@include 'css/nav_home.php'; 

session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);


   $select = " SELECT * FROM user_form WHERE email = '$email' && pass = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'Admin'){
         $_SESSION['id'] = $row['id'];
         $_SESSION['name'] = $row['name'];
         $_SESSION['type'] = 'Admin';
         header('location:admin/dashboard.php');

      }elseif($row['user_type'] == 'Donor'){

         $_SESSION['id'] = $row['id'];
         $_SESSION['name'] = $row['name'];
         $_SESSION['type'] = 'Donor';
         header('location:donor/donor_home.php');

      }elseif($row['user_type'] == 'Patient'){
         
         $_SESSION['id'] = $row['id'];
         $_SESSION['name'] = $row['name'];
         $_SESSION['type'] = 'Patient';
         header('location:patient/patient_home.php');
      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<header></header>
<div class="form-container" style="background-color:#192e3f">

   <form action="" method="post">
      <h1>WELCOME!</h1>
      <h3 style="font-weight:normal";>Login To Your Account</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="Enter your email">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="submit" name="submit" value="login" class="form-btn"><br>
      <p>Don't have an account? <a href="register_form.php">Register now</a></p>
      <p><a href="">Forgot Your Password?</a></p>
   </form>

</div>

</body>
</html>