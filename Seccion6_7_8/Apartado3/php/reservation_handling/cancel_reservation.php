<?php

require('../db_management/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $hotelName = $_POST['hotelName'];
    if (!empty($hotelName)) {
        try {
            // Escape and quote the hotel name
            $quotedHotelName = $conn->quote($hotelName);
            $sql = "DELETE FROM reservations WHERE hotel_name = $quotedHotelName";
            $affectedRows = $conn->exec($sql);
            if ($affectedRows > 0) {
                header("Location: reservation_canceled.php?hotel=$hotelName");
                exit(); 
            } else {
                echo "No hotel found with the provided name.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid hotel name.";
    }
} else {
    echo "Invalid request method.";
}
// Closing the database connection
$conn = null;
?>
