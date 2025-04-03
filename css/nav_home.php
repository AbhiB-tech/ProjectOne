<?php

include('../connection/connection.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <style type="text/css">
    .bs-example {
      margin: 0px;
    }

    .navbar-brand {
      font-size: 20px;
      font-family: sans-serif;
    }

    .navbar-nav .nav-item .nav-link:hover {
      background-color: #FF0018;
      color: white;
    }
    
    .dropdown-menu .dropdown-item:hover {
      background-color: #FF0018;
      color: white;
    }
  </style>
</head>

<body>

  <div class="bs-example">
    <nav style="background-color: #FF0018;" class="navbar navbar-expand-md navbar-dark fixed-top">
        &nbsp;&nbsp;&nbsp;<a href="/" class="navbar-brand"><i class="fas fa-heartbeat"></i>&nbsp; Blood Bank Management</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
    
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" style="color: white;" href="index.php"><i class="fas fa-home"></i>&nbsp; Home  </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: white;" href="why.php"><i class="fas fa-question-circle"></i>&nbsp;Why Donate Blood?</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: white;" href="register_form.php"><i class="fas fa-user-plus"></i>&nbsp;Register Now</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: white;" href="login_form.php"><i class="fas fa-user-circle"></i>&nbsp;Login</a>
            </li>
        </ul>
    </div>
</div></div>
  

</body>
</html>