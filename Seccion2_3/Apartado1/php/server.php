<?php
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
