<?php
session_start();
@include '../connection/connection.php';
@include '../css/navbar.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$regvalue = $_SESSION['id'];

$query = "SELECT * FROM user_form WHERE id=$regvalue";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $id = $row["id"];
    $diseases = $row["diseases"];
    $BloodGroup = $row["BloodGroup"];
} else {
    echo "User data not found.";
    exit();
}

if (isset($_POST['submit'])) {

    $diseases = $_POST['diseases'];
    $units = $_POST['units'];
    $status = "Pending"; 

    $insert = "INSERT INTO requestshistory (id, blood_group, diseases, units, date, status) VALUES ('$id', '$BloodGroup', '$diseases', '$units', current_timestamp(), '$status')";
    if (mysqli_query($conn, $insert)) {
        echo "Request submitted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    $query = "UPDATE request SET RequestsMade=RequestsMade+1 WHERE id=? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id); 
    $stmt->execute();
    $stmt->close();

    $query = "UPDATE request SET PendingRequests=PendingRequests+1 WHERE id=? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id); 
    $stmt->execute();
    $stmt->close();

    $query = "UPDATE blood SET units = units+1 WHERE Blood_Group = 'TotalRequests' ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Request Blood Form</title>
   <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="form-container" style="background-color:#192e3f">
   <form action="" method="post">
      <h3>Request Blood</h3>
      <?php
      if (isset($error)) {
         foreach ($error as $error) {
            echo '<span class="error-msg">' . $error . '</span>';
         }
      }
      ?>
      <input type="text" name="diseases" required placeholder="Enter patient diseases" value="<?php echo $diseases; ?>">
      <input type="text" name="bloodgroup" value="<?php echo $BloodGroup; ?>" class="field left" readonly>
      <input type="number" name="units" required placeholder="Enter Blood Units">
      <input type="submit" name="submit" value="Request Blood" class="form-btn">
   </form>
</div>
</body>
</html>
