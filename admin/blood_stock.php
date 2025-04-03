<?php

ob_start();

@include '../connection/connection.php';
@include '../css/navbar.php';

$query = "SELECT * FROM blood";
$result = mysqli_query($conn, $query);

$blood_data = [];
if ($result&& mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $blood_data[$row['Blood_Group']] = $row['units'];
    }
}

if (isset($_POST['submit'])) {
    $Blood_Group = mysqli_real_escape_string($conn, $_POST['Blood_Group']);
    $unit = mysqli_real_escape_string($conn, $_POST['unit']);
    
    $sql = "UPDATE blood SET units = units+'$unit' WHERE Blood_Group = '$Blood_Group'";
    mysqli_query($conn, $sql);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <title>Blood Stock</title>
    <style>
        body {
          font-family: 'Arial', sans-serif;
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }
    
        header {
          background-color: #333;
          color: #fff;
          padding: 23px;
          text-align: center;
        }
    
        main {
          display: flex;
          flex-wrap: wrap;
          justify-content: space-around;
          padding: 20px;
        }
    
        .item {
          border: 1px solid #ccc;
          margin: 10px auto;
          padding: 15px;
          width: 230px;
          height: 100px;
          border-radius: 14px;
          text-align: center;
          box-shadow: 10px 10px 5px rgb(82, 11, 11);
        }
    
        @media screen and (min-width: 570px) {
          main {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 0 ;
          }
        }
    </style>
</head>
<body><header></header>

<main>
    <?php
    $blood_groups = ['A+','B+','O+','AB+','A-','B-','O-','AB-'];
    foreach ($blood_groups as $group) {
        $units = isset($blood_data[$group]) ? $blood_data[$group] : '0';
        echo '<div class="item">';
        echo '<h2 style="text-align:right;">' . $group . ' <img src="../css/blood2.png" alt="BLOOD LOGO" width="40" height="50"/></h2>';
        echo '<p style="text-align:left;">' . $units . '</p>';
        echo '</div>';
    }
    ?>
</main>

<div class="container">
    <h2>Add Blood Unit</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="Blood_Group">Choose Blood Group</label>
            <select name="Blood_Group" id="Blood_Group" class="form-control" required>
                <option disabled selected>Choose Blood Group</option>
                <option>O+</option>
                <option>O-</option> 
                <option>A+</option>
                <option>A-</option>
                <option>B+</option>
                <option>B-</option>
                <option>AB+</option>
                <option>AB-</option>
            </select>
        </div>
        <div class="form-group">
            <label for="unit">Blood Unit</label>
            <input type="number" name="unit" id="unit" class="form-control" required placeholder="Blood Unit">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Update" class="btn btn-primary">
        </div>
    </form>
</div>

</body>
</html>
