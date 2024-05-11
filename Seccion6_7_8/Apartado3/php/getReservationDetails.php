<?php
session_start();
require('./db_management/db_connection.php');

$hotelName = urldecode($_GET['hotelName']);

try {
    $stmt = $conn->prepare("SELECT name, checkin_date, checkout_date FROM reservations WHERE hotel_name = :hotelName");
    $stmt->bindParam(':hotelName', $hotelName, PDO::PARAM_STR);
    $stmt->execute();
    $reservationDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($reservationDetails);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
