<?php

ob_start();

@include '../connection/connection.php';
@include '../css/navbar.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["id"]) || !isset($_GET["UserType"])) {
        if ($user_type == 'Donor') {
            header("location: ../admin/donor_list.php");
        } else {
            header("location: ../admin/patient_list.php");
        }
        exit;
    }

    $id = $_GET["id"];
    $UserType = $_GET["UserType"];

    $query = "SELECT * FROM user_form WHERE id=$id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        if ($UserType == 'Donor') {
            header("location: ../admin/donor_list.php");
        } else {
            header("location: ../admin/patient_list.php");
        }
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $age = $row["age"];
    $gender = $row["gender"];
    $number = $row["number"];
    $BloodGroup = $row["BloodGroup"];
    $diseases = $row['diseases'];
    $address = $row["address"];
} else {
    $id = $_POST["id"];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $number = $_POST['number'];
    $BloodGroup = $_POST['BloodGroup'];
    $diseases = $_POST['diseases'];
    $address = $_POST['address'];

    if (!empty($BloodGroup)) {
        $bloodgroup_check_query = "SELECT * FROM blood WHERE Blood_Group='$BloodGroup'";
        $bloodgroup_check_result = mysqli_query($conn, $bloodgroup_check_query);

        if (mysqli_num_rows($bloodgroup_check_result) > 0) {
            $sql = "UPDATE user_form SET name = '$name', email = '$email', age = '$age', gender = '$gender', number = '$number', BloodGroup = '$BloodGroup', address = '$address' WHERE id = $id";
            if (mysqli_query($conn, $sql)) {
                if ($_POST['UserType'] == 'Donor') {
                    header("location: ../admin/donor_list.php");
                } else {
                    header("location: ../admin/patient_list.php");
                }
                exit;
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            echo "Invalid Blood Group.";
        }
    } else {
        echo "Blood Group is required.";
    }
}

ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Details</title>

   <style>
      header {
         background-color: #333;
         color: #fff;
         padding: 30px;
         text-align: center;
      }
   </style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
  <header></header>
  <div class="form-container" style="background-color:#192e3f">
      <form action="" method="post">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <h3>Edit Details</h3>
          <?php
          if (isset($error)) {
              foreach ($error as $error) {
                  echo '<span class="error-msg">'.$error.'</span>';
              }
          }
          ?>
          <input type="text" name="name" required placeholder="Enter Donor Name" value="<?php echo $name; ?>">
          <input type="email" name="email" required placeholder="Enter Donor Email" value="<?php echo $email; ?>">
          <input type="number" name="age" required placeholder="Enter Donor Age" value="<?php echo $age; ?>">      
          <select name="gender" class="form-control">
              <option disabled="disabled" selected="selected"><?php echo $gender; ?></option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
          </select>
          <input type="number" name="number" required placeholder="Enter Donor Phone Number" value="<?php echo $number; ?>">
          <select name="BloodGroup" class="form-control">
              <option disabled="disabled" selected="selected"><?php echo $BloodGroup; ?></option>
              <option value="O+">O+</option>
              <option value="O-">O-</option> 
              <option value="A+">A+</option>
              <option value="A-">A-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
          </select>
          <input type="text" name="diseases" required placeholder="Enter your Diseases ('If Any')" value="Nothing">
          <input type="text" name="address" required placeholder="Enter your Address" value="<?php echo $address; ?>">
          <input type="hidden" name="UserType" value="<?php echo $UserType; ?>">
          <input type="submit" name="submit" value="Update Details" class="form-btn">
      </form>
  </div>
</body>
</html>
