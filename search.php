<!doctype html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <title>Carrllix</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="images/logo.png">
    <!-- Font Awesome icons (free version)-->
    <script src="https://kit.fontawesome.com/4ec8ec9cb4.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="styl.css?v=<?php echo time() ?>" rel="stylesheet">
    <link href="calendar.css?v=<?php echo time() ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body style="cursor: pointer; overflow-x:scroll; min-width:400px;">
    <?php
    session_start();
    if (isset ($_SESSION['user_id'])) {
        echo '  <div class="navbar bg-body-tertiary">
            <div class="container-fluid">
              <div class="row w-100 border-bottom">
               <div class="col-12 col-md-6">
                 <h2>Witaj, ' . $_SESSION['username'] . '</h2>
                </div>
                <div class="col-12 col-md-6 d-flex justify-content-end">
                  <a href="admin-panel.php"><div class="btn btn-primary mr-1">Panel admina</div></a>
                  <a href="logout.php"><div class="btn btn-primary">Wyloguj się</div></a>
                </div>
              </div>  
            </div>
          </div>';
    }
    ?>
    <nav class="navbar navbar-light navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/logo.png" alt="" width="50" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor04"
                aria-controls="navbarColor04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor04">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Strona główna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="search.php">Wyszukiwarka</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Kontakt</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="reservation" class="pb-4">
        <button class="btn" onclick="disableReservationOverlay()"><i class="fa-solid fa-x"></i></button>
        <div class="container">
            <form method="post" action="reservation.php">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-primary" id="calendar-btn-left">Poprzedni</button>
                        <button class="btn btn-primary" id="calendar-btn-right">Następny</button>
                        <div id="calendar-container" style="z-index: 100;">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 card mt-3">
                        <div class="card-header bg-white">
                            <h3>Twoje dane</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="imie">Imię</label>
                                <input type="text" class="form-control" id="imie" name="imie" required>
                            </div>
                            <div class="form-group">
                                <label for="nazwisko">Nazwisko</label>
                                <input type="text" class="form-control" id="nazwisko" name="nazwisko" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required
                                    pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
                            </div>
                            <div class="form-group">
                                <label for="tel">Numer telefonu</label>
                                <input name="tel" id="tel" oninput="maxLengthCheck(this)" type="tel" maxlength="9"
                                    class="form-control" >
                                <script>
                                    function maxLengthCheck(object) {
                                        if (object.value.length > object.maxLength)
                                            object.value = object.value.slice(0, object.maxLength)
                                    }
                                </script>

                            </div>
                            <div class="form-group">
                                <label for="adres">Adres</label>
                                <input type="text" class="form-control" id="adres" name="adres" required>
                            </div>
                            <div class="form-group">
                                <label for="kod_pocztowy">Kod pocztowy</label>
                                <input type="text" class="form-control" id="kod_pocztowy" name="kod_pocztowy" required
                                    pattern="[0-9]{2}-[0-9]{3}">
                            </div>
                            <div class="form-miasto">
                                <label for="miasto">Miasto</label>
                                <input type="text" class="form-control" id="miasto" name="miasto" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-xs-12 col-sm-12 mt-3">
                        <div class="card">
                            <div class="card-header bg-white">
                                <h3>Twoja rezerwacja</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="reservation-date-start">Data rozpoczęcia:</label>
                                    <input type="date" class="form-control" id="reservation-date-start"
                                        name="data_rozpoczecia" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="reservation-date-stop">Data zakończenia:</label>
                                    <input type="date" class="form-control" id="reservation-date-stop"
                                        name="data_zakonczenia" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="idnumber">Numer prawa jazdy</label>
                                    <input type="number" class="form-control" id="idnumber" name="idnumber" required>
                                </div>
                                <div class="form-group">
                                    <label for="driversCount">Liczba kierowców</label>
                                    <input type="number" class="form-control" id="driversCount" name="driversCount"
                                        required max="4">
                                </div>
                            </div>
                        </div>
                        <div class="card col-xs-12 mt-3">
                            <div class="card-header bg-white">
                                <h3>Podsumowanie</h3>
                            </div>
                            <div class="card-body" id="generate-id-here">
                                <p>Samochód</p>
                            </div>
                            <button type="submit" class="btn btn-primary">Zrób rezerwacje</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="whole-body">
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
                                        <select class="form-control" name="brand" id="brand" required="required"
                                            data-validation-required-message="Wybierz markę.">
                                            <?php
                                            require_once 'functions.php';
                                            echo generateSelectFromBrand(connectToDatabase());
                                            ?>
                                        </select>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="model" id="model" required="required"
                                            data-validation-required-message="Wybierz model.">
                                            <?php
                                            require_once 'functions.php';
                                            $brand = "";
                                            echo generateSelectFromModel(connectToDatabase(), $brand);
                                            ?>
                                        </select>
                                        <p class="help-block text-danger"></p>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control" name="skrzynia" id="skrzynia" required="required"
                                            data-validation-required-message="Wybierz skrzynię samochodu.">
                                            <option value="" disabled selected hidden>Wybierz skrzynię samochodu
                                            </option>
                                            <option value="Manualna">Manualna</option>
                                            <option value="Automatyczna">Automatyczna</option>
                                        </select>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="naped" id="naped"
                                            data-validation-required-message="Wybierz napęd samochodu.">
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
                                    <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase"
                                        type="submit">Szukaj</button>
                                    <button id="sendMessageButton2" class="btn btn-primary btn-xl text-uppercase"
                                        type="button">Czyść</button>
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

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    @$brand = $_POST['brand'];
                    @$model = $_POST['model'];
                    @$skrzynia = $_POST['skrzynia'];
                    @$naped = $_POST['naped'];

                    if ($naped == "NULL") {
                        $sql = "SELECT * FROM samochody WHERE marka=? AND model=? AND skrzynia=?";
                        $stmt = $polaczenie->prepare($sql);
                        $stmt->bind_param("sss", $brand, $model, $skrzynia);
                    } else {
                        $sql = "SELECT * FROM samochody WHERE marka=? AND model=? AND naped=? AND skrzynia=?";
                        $stmt = $polaczenie->prepare($sql);
                        $stmt->bind_param("ssss", $brand, $model, $naped, $skrzynia);
                    }

                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        generateCard($result);
                    }
                    $stmt->close();

                    if ($result->num_rows == 0) {
                        generateAllCards($polaczenie);
                    }

                    closeConnection($polaczenie);
                } else {
                    generateAllCards($polaczenie);
                    closeConnection($polaczenie);
                }
                ?>
            </div>
        </div>
    </div>
    <footer class="bg-body-tertiary text-center footer fixed-footer" id="footer">
        <div class="container p-0 pb-0">
            <div class="">
                <!-- Facebook -->
                <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #3b5998;"
                    href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

                <!-- Twitter -->
                <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #55acee;"
                    href="#!" role="button"><i class="fab fa-twitter"></i></a>

                <!-- Google -->
                <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #dd4b39;"
                    href="#!" role="button"><i class="fab fa-google"></i></a>

                <!-- Instagram -->
                <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #ac2bac;"
                    href="#!" role="button"><i class="fab fa-instagram"></i></a>

                <!-- Linkedin -->
                <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #0082ca;"
                    href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
                <!-- Github -->
                <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #333333;"
                    href="#!" role="button"><i class="fab fa-github"></i></a>
            </div>
            <!-- Section: Social media -->
        </div>
        <div class="text-center p-3 " style="background-color: rgba(0, 0, 0, 0.05);">
            &copy; 2024 Copyright:
            <a class="text-body">zwirzaky</a>
        </div>
    </footer>
    <script src="eventListeners.js?v=<?php echo time() ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>