<?php
session_start();
require('./db_management/db_connection.php');

if (!isset($_SESSION['user']) || empty($_SESSION['user']['name'])) {
    error_log('Debug: User session is not set or username is empty.');
    header('Content-type: text/xml');
    echo '<?xml version="1.0"?><UserDetails><error>User not logged in or username missing</error></UserDetails>';
    exit;
}

$username = $_SESSION['user']['name'];

$stmt = $conn->prepare("SELECT name, email FROM users WHERE name = :username");
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
if (!$stmt->execute()) {
    error_log('Debug: Failed to execute query.');
    echo '<?xml version="1.0"?><UserDetails><error>Database query failed</error></UserDetails>';
    exit;
}

$result = $stmt->fetch(PDO::FETCH_ASSOC);
if ($result) {
    $xml = new SimpleXMLElement('<UserDetails/>');
    foreach ($result as $key => $value) {
        $xml->addChild($key, htmlspecialchars($value));
    }
    Header('Content-type: text/xml');
    echo $xml->asXML();
    error_log('Debug: XML generated and sent.');
} else {
    error_log('Debug: No data found for user.');
    echo '<?xml version="1.0"?><UserDetails><error>No data found for user</error></UserDetails>';
}
?>
