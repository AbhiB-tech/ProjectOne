<?php

@include '../connection/connection.php';
@include '../css/navbar.php'; 

$regValue = $_SESSION['id'];

if(isset($_POST['submit'])){

   $opass = md5($_POST['old_password']);
   $npass = md5($_POST['new_password']);
   $cpass = md5($_POST['new_cpassword']);

   $select = " SELECT pass FROM user_form WHERE id=$regValue";
   $result = mysqli_query($conn, $select);
   $row = mysqli_fetch_assoc($result);

    if($opass != $row['pass']){
        $error[] = 'Password not matched with your previous password!';
    }
    else{
        if($opass == $npass){
            $error[] = 'Please enter new password';
        }
        else if($npass != $cpass){
            $error[] = 'Password not matched!';
        }else{
            $update = "UPDATE user_form set pass='$npass' where id=$regValue";
            mysqli_query($conn, $update);
            $success[] = 'Password updated successfully!';
        }
    }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

   <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<div class="form-container" style="background-color:#192e3f">

   <form action="" method="post">
   <br>  
   <h3>Change Password</h3>
   <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      }
      if(isset($success)){
         foreach($success as $message){
            echo '<span class="success-msg">'.$message.'</span>';
         };
      }
      ?>
      <input type="password" name="old_password" required placeholder="Enter your Old Password">
      <input type="password" name="new_password" required placeholder="Enter your New Password">
      <input type="password" name="new_cpassword" required placeholder="Confirm your New Password">
      <input type="submit" name="submit" value="Change Password" class="form-btn">
   </form>

</div>

</body>
</html>