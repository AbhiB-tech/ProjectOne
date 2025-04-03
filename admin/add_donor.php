<?php

@include '../connection/connection.php';
@include '../css/navbar.php'; 

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $age = $_POST['age'];
   $pass = md5($_POST['pass']);
   $gender = $_POST['gender'];
   $number = $_POST['number'];
   $BloodGroup = $_POST['bloodgroup'];
   $diseases = $_POST['diseases'];
   $address = $_POST['address'];

   $select = " SELECT * FROM user_form WHERE email = '$email'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{
      $insert1 = "INSERT INTO user_form(name, email, age, pass, gender, number, BloodGroup, diseases, address, user_type) VALUES('$name','$email','$age','$pass','$gender','$number','$BloodGroup','$diseases','$address','Donor')";
      mysqli_query($conn, $insert1);

      $query = "SELECT id FROM user_form WHERE email='$email'";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);
      $id = $row['id'];

      $insert2 = "INSERT INTO request(id) VALUES ('$id')";
      mysqli_query($conn, $insert2);

      $query = "UPDATE blood SET units = units+1 WHERE Blood_Group = 'TotalDonors' ";
      $stmt = $conn->prepare($query);
      $stmt->execute();
      $stmt->close();
   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add donor form</title>
   <style>
      header {
         background-color: #333;
         color: #fff;
         padding: 30px;
         text-align: center;
      }
   </style>

   <link rel="stylesheet" href="../css/style.css">

</head>

<body>
<header></header>
<div class="form-container" style="background-color:#192e3f" >

   <form action="" method="post" >
      <h3>Add Donor</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="Enter Donor Name">
      <input type="email" name="email" required placeholder="Enter Donor Email">
      <input type="number" name="age" required placeholder="Enter Donor Age"> 
      <input type="password" name="pass" required placeholder="Enter Password" value="1234">     
      <select name="gender" class="form-control">
      <option disabled="disabled" selected="selected">Choose Donor Gender</option>
         <option value="Male">Male</option>
         <option value="Female">Female</option>
      <input type="number" name="number" required placeholder="Enter Donor Phone Number">
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
      <input type="text" name="diseases" required placeholder="Enter Diseases ('If Any')" value="Nothing">
      <input type="address" name="address" required placeholder="Enter Address">
      <input type="submit" name="submit" value="Add Donor" class="form-btn">
   </form>

</div>

</body>
</html>