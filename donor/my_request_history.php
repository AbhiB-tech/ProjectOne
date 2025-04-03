<?php

@include '../connection/connection.php';
@include '../css/navbar.php';

$regValue1 = $_SESSION['id'];
$regValue2 = $_SESSION['name'];

$query = "select * from requestshistory where id=$regValue1";
$result = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <title>My Request History</title>
    
    <link rel="stylesheet" href="https://stackpatd.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpatd.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

   <link rel="stylesheet" href="css/style.css">

    <style>
       table, td, td {
            border: 1px solid;
        }
        table {
            widtd: 200%;
            border-collapse: collapse;
        }
    </style>
</head>

<body class="bg-dark">
    <header>
    </header>
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="display-6 text-left">My Request History Details</h2>
                    </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                    <tr class="bg-dark text-white">
                    <link rel="stylesheet" href="../css/style.css">

                        <td> Name </td>
                        <td> Diseases </td>
                        <td> Blood Group </td>
                        <td> Units </td>
                        <td> Request Date </td>
                        <td> Status </td>
                    </tr>
                    <tr>
                    <?php 
                        while($row = mysqli_fetch_assoc($result)) { 
                    ?>
                        <td><?php echo $regValue2; ?></td>
                        <td><?php echo $row['diseases']; ?></td>
                        <td><?php echo $row['blood_group']; ?></td>
                        <td><?php echo $row['units']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                    <?php 
                        } 
                    ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
