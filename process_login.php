<?php
require_once("functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    login($username, $password);
}

function login($username, $password) {
    // Connect to the database
    $conn = connectToDatabase();

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare the SQL statement
    $stmt = null; // Define the $stmt variable

    $stmt = "SELECT * FROM users WHERE username = ?";

    $stmt = mysqli_prepare($conn, $stmt) or die("". mysqli_error($conn));

    // Bind the parameters
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    }

    // Execute the query


    // Check if the user exists
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify the password
        if ($password == $row['password']) {
            // Start the session
            session_start();

            // Store the user's ID in the session
            $_SESSION['user_id'] = $row['id'];

            // Redirect to the home page or any other page
            header("Location: admin-panel.php");
            exit();
        }
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();

    // If the login fails, redirect back to the login page
    header("Location: login.php?error=1");
    exit();
}

?>