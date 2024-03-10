<?php
    session_start();
    if (isset($_SESSION['user_id'])) {
        header("location: admin-panel.php");
    }
    ?>
<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Carrllix</title>
        <link rel="icon" type="image/x-icon" href="images/logo.png" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="styl.css?v=<?php echo time() ?>" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <!-- Your navigation code here -->
            </div>
        </nav>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Logowanie</h5>
                            <form method="post" action="process_login.php">
                                <div class="form-group">
                                    <label for="username">Nazwa użytkownika</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Wpisz nazwę użytkownika">
                                </div>
                                <div class="form-group">
                                    <label for="password">Hasło</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Wpisz hasło">
                                </div>
                                <button type="submit" class="btn btn-primary">Zaloguj się</button>
                                <?php
                                    if (isset($_GET['error'])) {
                                        
                                        $brand = $_GET['error'];
                                        echo "<div class='alert alert-danger mt-3' role='alert'>Niepoprawny login lub hasło</div>";
                                    }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
  </body>
</html>