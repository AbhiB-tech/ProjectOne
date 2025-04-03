<?php

@include '../connection/connection.php';
@include '../css/navbar.php';

$query = "SELECT * FROM blood";
$result = mysqli_query($conn, $query);

$blood_data = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $blood_data[$row['Blood_Group']] = $row['units'];
    }
}
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
    <title>home</title>
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
          padding: 30px;
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
          height: 120px;
          border-radius: 14px;
          text-align: center;
          box-shadow: 10px 10px 5px rgb(82, 11, 11);
        }

        @media screen and (min-width: 570px) {
          main {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
          }
        }
    </style>
</head>

<body >
<header></header>
<main>
    <?php
    $blood_groups = ['A+','B+','O+','AB+','A-','B-','O-','AB-'];
    foreach ($blood_groups as $group) {
        $units = isset($blood_data[$group]) ? $blood_data[$group] : '0';
        echo '<div class="item">';
        echo '<h2 style="text-align:right;">' . $group . ' <img src="../css/blood2.png" alt="BLOOD LOGO" width="40" height="50"/></h2>';
        echo '<b><p style="text-align:left;">' . $units . '</p></b>';
        echo '</div>';
    }
    ?>

    <div class="item">
        <h4 style="text-align:right;"><i class="fas fa-users" style="color: blue;"></i></h4>
        <b><p style="text-align:left;">Total Donors</p>
        <p style="text-align:left;"><?php echo isset($blood_data['TotalDonors']) ? $blood_data['TotalDonors'] : '0'; ?></p></b>
    </div>
    <div class="item">
        <h4 style="text-align:right;"><i class="fa fa-spinner" aria-hidden="true" style="color: blue;"></i></h4>
        <b><p style="text-align:left;">Total requests</p>
        <p style="text-align:left;"><?php echo isset($blood_data['TotalRequests']) ? $blood_data['TotalRequests'] : '0'; ?></p></b>
    </div>
    <div class="item">
        <h4 style="text-align:right;"><i class="fa fa-check-circle-o" aria-hidden="true" style="color: blue;"></i></h4>
        <b><p style="text-align:left;">Approved Requests</p>
        <p style="text-align:left;"><?php echo isset($blood_data['ApprovedRequests']) ? $blood_data['ApprovedRequests'] : '0'; ?></p></b>
    </div>
    <div class="item">
        <h4 style="text-align:right;"><img src="../css/blood2.png" alt="BLOOD LOGO" width="20" height="25"/></h4>
        <b><p style="text-align:left;">Total Blood Unit(in ml)</p>
        <p style="text-align:left;"><?php echo isset($blood_data['TotalBlood']) ? $blood_data['TotalBlood'] : '0'; ?></p></b>
    </div>
</main>

</body>
</html>
