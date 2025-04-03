<?php

@include 'connection/connection.php';
@include 'css/nav_home.php'; 

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $age = $_POST['age'];
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $gender = $_POST['gender'];
   $number = $_POST['number'];
   $BloodGroup = $_POST['bloodgroup'];
   $address = $_POST['address'];
   $diseases = $_POST['diseases'];
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && pass = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, age, pass, gender, number, BloodGroup, address, user_type, diseases) VALUES('$name','$email','$age','$pass','$gender','$number','$BloodGroup','$address','$user_type','$diseases')";
         mysqli_query($conn, $insert);

         $query = "SELECT id FROM user_form WHERE email='$email'";
         $result = mysqli_query($conn, $query);
         $row = mysqli_fetch_assoc($result);
         $id = $row['id'];
   
         $insert2 = "INSERT INTO request(id) VALUES ('$id')";
         mysqli_query($conn, $insert2);
         header('location:login_form.php');

         if($user_type == 'Donor'){
            $query = "UPDATE blood SET units = units+1 WHERE Blood_Group = 'TotalDonors' ";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->close();
         }
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

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   <header></header>

<div class="form-container" style="background-color:#192e3f">

   <form action="" method="post">
   <br>  
   <h3>Create Account</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="Enter your Name">
      <input type="email" name="email" required placeholder="Enter your Email">
      <input type="number" name="age" required placeholder="Enter Your Age">
      <input type="password" name="password" required placeholder="Enter your Password">
      <input type="password" name="cpassword" required placeholder="Confirm your Password">
      <select name="gender" class="form-control">
      <option disabled="disabled" selected="selected">Choose Your Gender</option>
         <option value="Male">Male</option>
         <option value="Female">Female</option>
      <input type="number" name="number" required placeholder="Enter Phone Number">
      <select name="bloodgroup" class="form-control">
         <option disabled="disabled" selected="selected">Choose Blood Group</option>
         <option>O+</option>
         <option>O-</option> 
         <option>A+</option>
         <option>A-</option>
         <option>B+</option>
         <option>B-</option>
         <option>AB+</option>
         <option>AB-</option>
      </select>
      <input type="address" name="address" required placeholder="Enter your Address">
      <select name="user_type">
      <option disabled="disabled" selected="selected">Choose User Type</option>
         <option value="Donor">Donor</option>
         <option value="Patient">Patient</option>
      </select>
      <input type="text" name="diseases" required placeholder="Enter your Diseases ('If Any')" value="Nothing">
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>Already have an account? <a href="login_form.php">Login now</a></p>
   </form>

</div>

</body>

</html>