<?php

@include '../connection/connection.php';

if (isset($_GET["id"]) && isset($_GET["date"])) {
    $id = $_GET["id"];
    $date = $_GET["date"];

    $query = "UPDATE request SET PendingRequests=PendingRequests-1 WHERE id=? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id); 
    $stmt->execute();
    $stmt->close();

    $query = "UPDATE request SET RejectedRequests=RejectedRequests+1 WHERE id=? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id); 
    $stmt->execute();
    $stmt->close();

    $query = "UPDATE requestshistory SET status='Rejected' WHERE id=? AND date=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $id, $date); 
    $stmt->execute();
    $stmt->close(); 
}

header("Location: blood_requests.php");
exit;
?>
