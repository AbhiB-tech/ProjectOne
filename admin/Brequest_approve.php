<?php

@include '../connection/connection.php';

if (isset($_GET["id"]) && isset($_GET["blood_group"]) && isset($_GET["units"]) && isset($_GET["date"])) {
    $id = $_GET["id"];
    $blood_group = $_GET["blood_group"];
    $units = intval($_GET["units"]);
    $date = $_GET["date"];

    $query = "SELECT units FROM blood WHERE Blood_Group = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $blood_group);
    $stmt->execute();
    $stmt->bind_result($current_units);
    $stmt->fetch();
    $stmt->close();

    $new_units = $current_units - $units;

    $sql = "UPDATE blood SET units = ? WHERE Blood_Group = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $new_units, $blood_group);
    $stmt->execute();
    $stmt->close();

    $query = "UPDATE blood SET units = units - ? WHERE Blood_Group = 'TotalBlood'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $units);
    $stmt->execute();
    $stmt->close();

    $query = "UPDATE blood SET units = units+1 WHERE Blood_Group = 'ApprovedRequests' ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->close();

    $query = "UPDATE request SET PendingRequests=PendingRequests-1 WHERE id=? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id); 
    $stmt->execute();
    $stmt->close();

    $query = "UPDATE request SET ApprovedRequests=ApprovedRequests+1 WHERE id=? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id); 
    $stmt->execute();
    $stmt->close();
    
    $query = "UPDATE requestshistory SET status='Approved' WHERE id=? AND date=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $id, $date); 
    $stmt->execute();
    $stmt->close();    
}

header("Location: blood_requests.php");
exit;
?>
