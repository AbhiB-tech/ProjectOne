<?php

@include '../connection/connection.php';
@include '../css/navbar.php';

$query = "select * from user_form";
$result = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Details</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

   <link rel="stylesheet" href="css/style.css">

    <style>
       
       table, td, th {
            border: 1px solid;
        }

        table {
            width: 200%;
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
                        <h2 class="display-6 text-left">Donor List</h2>
                    </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                    <tr class="bg-dark text-white">
                    <link rel="stylesheet" href="css/style.css">

                        <td> ID </td>
                        <td> Name </td>
                        <td> Blood Group </td>
                        <td> Age </td>
                        <td> Diseases </td>
                        <td> Email </td>
                        <td> Update </td>
                        <td> Delete </td>
                    </tr> 
                    <tr>
                    <?php
                    
                        while($row = mysqli_fetch_assoc($result))
                        { if( $row['user_type'] =='Donor')
                            {
                                echo"
                                <tr>
                                    <td>$row[id]</td>
                                    <td>$row[name]</td>
                                    <td>$row[BloodGroup]</td>
                                    <td>$row[age]</td>
                                    <td>$row[diseases]</td>
                                    <td>$row[email]</td>
                                    <td><a  class='btn btn-primary' href='edit.php?id=$row[id]&UserType=Donor'>Edit</a></td>
                                    <td><a  class='btn btn-danger' href='delete.php?id=$row[id]&UserType=Donor'>Delete</a></td>
                                </tr>
                                ";
                        }
                    }

                    ?>


</body>
</html>