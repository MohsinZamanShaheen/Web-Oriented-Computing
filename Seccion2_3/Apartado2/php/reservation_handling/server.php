<?php

require('../db_management/db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $checkinDate = $_POST['checkinDate'];
    $checkoutDate = $_POST['checkoutDate'];
    $comments = $_POST['comments'];
    $hotelName = $_POST['hotel'];
    $price = $_POST['price'];

    //Validation via REGEXP
    $email_regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    $phone_regex = '/^\d{3}-\d{3}-\d{3}$/';

    // Validate input
    $errors = [];
    if(strlen($name) < 1){
        $errors[] = "Name cannot be empty";
    }
    if (!preg_match($email_regex, $email)) {
        $errors[] = "Invalid email format";
    }
    if (!preg_match($phone_regex, $phone)) {
        $errors[] = "Invalid phone number format";
    }

    // Validation of dates
    $checkin_timestamp = strtotime($checkinDate);
    $checkout_timestamp = strtotime($checkoutDate);

    // Check if the checkout date is before the check-in date
    if ($checkout_timestamp < $checkin_timestamp) {
        $errors[] = " Checkout date cannot be before the check-in date.";
    } else {
        echo "Checkout date is valid.";
    }

    // If there are no errors, proceed to display confirmation
    if (empty($errors)) {
        
        
        // Operations to database
        // Check if the reservations table exists

        $statement = $conn->prepare("SELECT 1 FROM information_schema.tables WHERE table_schema = ? AND table_name = ?");
        $statement->execute([$database, 'reservations']);
        $tableExists = ($statement->fetchColumn() !== false);

        if (!$tableExists) {
            // Create the table
            $reser_table = "CREATE TABLE reservations (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(30) NOT NULL,
                email VARCHAR(50) NOT NULL,
                phone VARCHAR(15) NOT NULL,
                checkin_date DATE NOT NULL,
                checkout_date DATE NOT NULL,
                comments TEXT,
                hotel_name VARCHAR(50) NOT NULL,
                price VARCHAR(6) NOT NULL
            )";
            $conn->exec($reser_table);
            echo "Table MyGuests created successfully";
        }
        // Just insert data into the table
        $insert = "INSERT INTO reservations (name, email, phone, checkin_date, checkout_date, comments, hotel_name, price) VALUES ('$name', '$email', '$phone', '$checkinDate', '$checkoutDate', '$comments', '$hotelName', '$price')";
        $conn->exec($insert);
        echo "New record created successfully";
        $conn = null;

        // Display confirmation page
        header("Location: confirmation.php?hotel=$hotelName&price=$price&name=$name&email=$email&phone=$phone&checkin=$checkinDate&checkout=$checkoutDate&comments=$comments");
        exit(); 
    } else {
        // Display errors page
        header("Location: errors.php?hotel=$hotelName&price=$price&errors=" . urlencode(implode(",", $errors)));
        exit();
    }
}
?>
