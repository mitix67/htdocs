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
            <a class="navbar-brand" href="#">
            <img src="images/logo.png" alt="" width="50" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor04" aria-controls="navbarColor04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor04">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Strona główna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Wyszukiwarka</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Cennik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">O nas</a>
                </li> 
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-sm-2" type="search" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Wyszukiwarka</h2>
                    <h3 class="section-subheading text-muted">Znajdź swoje wymarzone auto</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                    <select class="form-control" name="brand" id="brand" required="required" data-validation-required-message="Wybierz markę.">
                                        <?php 
                                            require_once 'functions.php';
                                            echo generateSelectFromBrand(connectToDatabase());
                                        ?>
                                    </select>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                <select class="form-control" name="model" id="model" required="required" data-validation-required-message="Wybierz model.">
                                        <?php 
                                            require_once 'functions.php';
                                            echo generateSelectFromModel(connectToDatabase(), $brand);
                                        ?>
                                    </select>
                                    <p class="help-block text-danger"></p>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="skrzynia" id="skrzynia" required="required" data-validation-required-message="Wybierz skrzynię samochodu.">
                                        <option value="Manualna">Manualna</option>
                                        <option value="Automatyczna">Automatyczna</option>
                                    </select>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="naped" id="naped" data-validation-required-message="Wybierz napęd samochodu.">
                                        <option value="NULL">Wybierz napęd</option>
                                        <option value="FWD">FWD</option>
                                        <option value="RWD">RWD</option>
                                        <option value="AWD">AWD</option>
                                    </select>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Wyślij</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Ładne kwadratowe kafelki z wynikami wyszukiwania -->
    <div class="container">
        <div class="row" id="playground">
            
            <?php
            require_once 'functions.php';
            $polaczenie = connectToDatabase();

                if ($_SERVER['REQUEST_METHOD'] == 'POST'){

                    @$brand = $_POST['brand'];
                    @$model = $_POST['model'];
                    @$skrzynia = $_POST['skrzynia'];
                    @$naped = $_POST['naped'];

                    if ($naped == "NULL") {
                        $sql = "SELECT * FROM samochody WHERE marka='$brand' AND model='$model' AND skrzynia='$skrzynia'";
                    }
                    else {
                        $sql = "SELECT * FROM samochody WHERE marka='$brand' AND model='$model' AND naped='$naped' AND skrzynia='$skrzynia'";
                    }

                    $result = querySelect($polaczenie, $sql);
                    $wynik = $polaczenie ->query($sql);

                    if($wynik ->num_rows > 0){
                        generateCard($wynik);
                    }
                    $polaczenie ->close();
                }
                else {
                    generateAllCards($polaczenie);
                    closeConnection($polaczenie);
                }
            ?>
            </div>
        </div>
    </section>
    <script src="eventListeners.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>