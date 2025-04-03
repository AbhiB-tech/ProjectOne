<?php
        
    @include '../connection/connection.php';  

    if( isset($_GET["id"]) && isset($_GET["UserType"]) ) {
        $id = $_GET["id"];
        $UserType = $_GET["UserType"];

        $sql1 = "DELETE FROM donationshistory WHERE id=$id";
        $sql3 = "DELETE FROM requestshistory WHERE id=$id";
        $sql2 = "DELETE FROM request WHERE id=$id";
        $sql4 = "DELETE FROM user_form WHERE id=$id";
        
        $conn->query($sql1);
        $conn->query($sql2);
        $conn->query($sql3);
        $conn->query($sql4);
    }
    if($UserType == 'Donor'){
    header("location: donor_list.php");
    }else{
        header("location: patient_list.php");
    }
    exit;
    
?>