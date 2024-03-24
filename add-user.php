<!DOCTYPE html>
<html lang="pl-pl">
<head>
    <title>Dodaj użytkownika</title>
    <meta charset="UTF-8">
    <meta name="description" content="Wypożyczalnia samochodów">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="checkmark.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar bg-body-tertiary" id="lolz">
            <div class="container-fluid">
                <div class="row w-100 border-bottom">
                    <div class="col-6">
                    <h2>Dodaj użytkownika</h2>
                </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="admin-panel.php"><div class="btn btn-primary">Wróć</div></a>
            </div>
        </div>
    </div>
    </nav>
    <div id="lala" class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                <form action="add-user.php" method="POST">
                        <?php 
                            session_start();
                            if (isset($_SESSION['user_id'])) {

                                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                        require_once 'functions.php';

                                        $username = $_POST['username'];
                                        $password = $_POST['password'];
                                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                                        $conn = connectToDatabase();

                                        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");

                                        $stmt->bind_param("ss", $username, $hashedPassword);
                                    

                                        if ($stmt->execute()) {
                                            echo '<div id="dis">';
                                            echo '<svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>';
                                            echo '</div>';
                                            header("refresh:3;url=admin-panel.php");
                                        // echo "<div id='countdown'>Redirecting in: 5</div>";
                                            echo "<script>
                                                var count = 5;
                                                var countdown = setInterval(function() {
                                                count--;
                                                //document.getElementById('lala').innerHTML = 'Redirecting in: ' + count;
                                                if (count === 0) {
                                                    clearInterval(countdown);
                                                }
                                                }, 1000);
                                            </script>";
                                            exit;
                                        } else {
                                            echo "Error: " . $stmt->error;
                                        }

                                        $stmt->close();
                                        $mysqli->close();
                                    }
                            }
                            else
                            {
                            include "style.php";
                            header("refresh:3;url=index.php");
                            echo '
                            <div class="container1">
                                <div class="circle-border"></div>
                                <div class="circle">
                                <div class="error"></div>
                                </div>
                                <div style="margin-top:150px;">
                                <p class="text-danger">Error: No id parameter provided.
                                ';
                                echo "<div id='countdown'>Redirecting in: 3</div>";
                                echo '<script>
                                    document.getElementById("lolz").innerHTML = "";
                                    var count = 3;
                                    var countdown = setInterval(function() {
                                    count--;
                                    document.getElementById("countdown").innerHTML = "Redirecting in: " + count;
                                    if (count === 0) {
                                        clearInterval(countdown);
                                    }
                                    }, 1000);
                                </script>';
                                echo '
                                </p>
                                </div>
                            </div>';
                            exit;
                            }
                        ?>  
                                                <div class="form-group">
                            <label for="username">Nazwa użytkownika:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Hasło:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Dodaj</button>
                    </form>
                </div>
            </div>
        </div>
</body>
</html>
