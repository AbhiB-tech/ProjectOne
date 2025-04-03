<?php

@include '../connection/connection.php';
@include '../css/navbar.php';

$regvalue = $_SESSION['id'];

$query = "SELECT * FROM request where id = $regvalue";
$result = mysqli_query($conn, $query);
$request_data = mysqli_fetch_assoc($result);

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
          padding: 28px;
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
          height:120px;
          border-radius:14px;
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
<body>
  <header></header>
    <main>     

        <div class="item">
            <h4 style="text-align:right;"><i class="fa fa-refresh" style="color: blue;"></i></h4>
            <b><p style="text-align:left;">Requests Made</p>
            <p style="text-align:left;"><?php echo isset($request_data['RequestsMade']) ? $request_data['RequestsMade'] : '0'; ?></p></b>
        </div>
        <div class="item">
            <h4 style="text-align:right;"><i class="fa fa-spinner" aria-hidden="true" style="color: blue;"></i></h4>
            <b><p style="text-align:left;">Pending Requests</p>
            <p style="text-align:left;"><?php echo isset($request_data['PendingRequests']) ? $request_data['PendingRequests'] : '0'; ?></p></b>
        </div>
        <div class="item">
            <h4 style="text-align:right;"><i class="fa fa-check-circle" aria-hidden="true" style="color: blue;"></i></h4>
            <b><p style="text-align:left;">Approved Requests</p>
            <p style="text-align:left;"><?php echo isset($request_data['ApprovedRequests']) ? $request_data['ApprovedRequests'] : '0'; ?></p></b>
        </div>
        <div class="item">
            <h4 style="text-align:right;"><i class="fa fa-times-circle" aria-hidden="true" style="color: blue;"></i></h4>
            <b><p style="text-align:left;">Rejected Requests</p>
            <p style="text-align:left;"><?php echo isset($request_data['RejectedRequests']) ? $request_data['RejectedRequests'] : '0'; ?></p></b>
        </div>

    </main>
</body>
</html>