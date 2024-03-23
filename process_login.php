<?php

session_start();

require_once ("functions.php");
if (isset ($_SESSION['user_id'])) {
    header("Location: admin-panel.php");
    exit;
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $conn = connectToDatabase();

        if ($conn->connect_error) {
            die ("Connection failed: " . $conn->connect_error);
        }

        $stmt = null;

        $stmt = "SELECT * FROM users WHERE username = ?";

        $stmt = mysqli_prepare($conn, $stmt) or die ("" . mysqli_error($conn));

        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();

                // Verify the hashed password
                if (password_verify($password, $row['password']) || $password == $row['password']) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    header("Location: admin-panel.php");
                    exit();
                }
            }
        }

        $stmt->close();
        $conn->close();

        header("Location: login.php?error=1");
        exit();
    }
}
?>