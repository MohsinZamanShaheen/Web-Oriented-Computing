<?php

require('../db_management/db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if it's a login request
    if ($_POST['action'] == 'login') {

        $email = $_POST['emailInput'];
        $password = $_POST['passwordInput'];

        // Check if the users table exists
        $statement = $conn->prepare("SELECT 1 FROM information_schema.tables WHERE table_schema = ? AND table_name = ?");
        $statement->execute([$database, 'users']);
        $tableExists = ($statement->fetchColumn() !== false);

        if (!$tableExists) {
            echo "No users found! PLEASE SIGN UP FIRST!";
            exit();
        }

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            echo "Login successful!";
            $_SESSION['user'] = $user;
            header("Location: ../../paginaBootstrap.php");
        } else {
            echo "Invalid email or password!";
        }
    }
    // Check if it's a signup request
    elseif ($_POST['action'] == 'signup') {
        $name = $_POST['nameInput'];
        $email = $_POST['emailInput'];
        $password = $_POST['passwordInput']; 

        // Check if the users table exists
        $statement = $conn->prepare("SELECT 1 FROM information_schema.tables WHERE table_schema = ? AND table_name = ?");
        $statement->execute([$database, 'users']);
        $tableExists = ($statement->fetchColumn() !== false);

        if($tableExists)
        {
            $existingUser = $conn->query("SELECT * FROM users WHERE name = '$name' OR email = '$email' LIMIT 1");
            if($existingUser->rowCount() > 0){
                header("Location: ../aver.php");
                exit();
            }else{
                // Hash the password before storing it in the database
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Insert the user data into the database
                $insert = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
                $conn->exec($insert);
                $conn = null;

                header("Location: ../../authenticate/login.php");
                exit();
            }
        }else{
            // Create the users table
            $createTableSQL = "CREATE TABLE users (
                user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(30) NOT NULL,
                email VARCHAR(50) NOT NULL,
                password VARCHAR(255) NOT NULL
            )";
            $conn->exec($createTableSQL);
            echo "Users table created successfully";


            // Hash the password before storing it in the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert the user data into the database
            $insert = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
            $conn->exec($insert);
            $conn = null;

            header("Location: ../../authenticate/login.php");
            exit();
        }
    }
}
