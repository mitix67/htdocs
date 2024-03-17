<!DOCTYPE html>
<html>
<head>
    <title>Dodaj użytkownika</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <div class="row w-100 border-bottom">
                    <div class="col-6">
                    <h2>Dodaj użytkownika</h2>
                </div>
            <div class="col-6 d-flex justify-content-end">
                <a href="admin-panel.php"><div class="btn btn-primary">Wróć</div></a>
            </div>
        </nav>
    <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="add-user.php" method="POST">
                        <div class="form-group">
                            <label for="username">Nazwa użytkownika:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Hasło:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add User</button>
                        <?php 
                            session_start();
                            if (isset($_SESSION['user_id'])) {

                                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    require_once 'functions.php';

                                    $username = $_POST['username'];
                                    $password = $_POST['password'];

                                    $conn = connectToDatabase();
                                    
                                    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");


                                    $stmt->bind_param("ss", $username, $password);

                                    if ($stmt->execute()) {
                                        echo "<div class='text-success'>Użytkownik dodany pomyślnie</div>";
                                        exit;
                                    } else {
                                        echo "Error: " . $stmt->error;
                                    }

                                    $stmt->close();
                                    $mysqli->close();
                                }

                            } else {
                                echo "Error: You dont have acces to this site.";
                                header("refresh:5;url=index.php");
                                echo "<div id='countdown'>Redirecting in: 5</div>";
                                echo "<script>
                                    var count = 5;
                                    var countdown = setInterval(function() {
                                    count--;
                                    document.getElementById('countdown').innerHTML = 'Redirecting in: ' + count;
                                    if (count === 0) {
                                        clearInterval(countdown);
                                    }
                                    }, 1000);
                                </script>";
                                exit;
                            }
                        ?>  
                    </form>
                </div>
            </div>
        </div>
</body>
</html>
