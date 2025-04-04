<?php

include('../connection/connection.php');
session_start();

if (!isset($_SESSION['name'])) {
    header('Location: index.php');
    exit();
}
$select = " SELECT * FROM user_form";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);

$regValue2 = $_SESSION['id'];
$regValue1 = $_SESSION['type'];
$regValue = $_SESSION['name'];

$_SESSION['id'] = $regValue2;
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
    <?php 
    if($regValue1 == 'Admin'){
      @include 'sidebar_admin.php';
    }elseif($regValue1 == 'Donor'){
      @include 'sidebar_donor.php';
    }elseif($regValue1 == 'Patient'){
      @include 'sidebar_patient.php';
    }
    ?>
      &nbsp;&nbsp;&nbsp;<a href="/" class="navbar-brand"><i class="fas fa-heartbeat"></i>&nbsp; Health Care Center </a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="color:white";><i class="fas fa-user-tie" ></i> Hello, <?php echo htmlspecialchars($regValue); ?></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="profile.php" class="dropdown-item">Profile</a>
              <a href="../css/change_pass.php" class="dropdown-item" >Change Password</a>
              <a href="../css/logout.php" class="dropdown-item" >Logout</a>
              <div class="screen">
              </div>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  

</body>
<script>
  function menu()
  {
    document.querySelector('.screen').innerHTML=`<a href="sidebar_gpt.php"></a>`;
  }
</script>

</html>
