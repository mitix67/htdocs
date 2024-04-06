<!doctype html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrllix</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png">
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="styl.css?v=<?php echo time() ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
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
                        <a class="nav-link active" href="#">Strona główna
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="search.php">Wyszukiwarka</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Kontakt</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <header class="masthead">
            <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
                <div class="d-flex justify-content-center">
                    <div class="text-center">
                        <h1 class="mx-auto my-0 text-uppercase">Carrllix</h1>
                        <h2 class="text-white-50 mx-auto mt-2 mb-5">Wynajmij swój wymarzony samochód!</h2>
                        <a class="btn btn-dark" href="search.php">Rozpocznij</a>
                    </div>
                </div>
            </div>
        </header>
        <section class="about-section text-center" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="text-white mb-4">Wypróbuj swój wymarzony samochód</h2>
                        <p class="text-white-50">
                            Posiadamy ogromny wybór samochodów, które możesz wynająć na dowolny okres czasu.
                            Większość naszej floty to ikoniczne pojazdy z lat 90-tych, które z pewnością zwrócą uwagę
                            innych.
                        </p>
                    </div>
                </div>
            </div>
        </section>
            <h3 class=" text-center bg-light m-0 p-2">Sprawdź nasze naklejki!</h3>
            <section class="container-fluid m-0 p-0 bg-light d-flex justify-content-center">
                <canvas id="canvas"></canvas>
                <script src="canvas.js?v=<?php echo time() ?>"></script>
            </section>
        <section class="projects-section bg-light" id="projects">
            <div class="container px-4 px-lg-5">
                <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                    <div class="col-xl-8 col-lg-7 m-0 p-0">
                        <img class="img-fluid mb-lg-0 w-100 p-0 m-0" src="images/lexusis200.webp" alt="...">
                    </div>
                    <div class="col-xl-4 col-lg-5 m-0 p-0">
                        <div class="featured-text text-center text-lg-left">
                            <h4>Lexus is 200</h4>
                            <p class="text-black-50 mb-0">Następca kultowej AE 86, zmodyfikowany przez renomowanych tunerów.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                    <div class="col-lg-6 p-0"><img class="w-100 img-fluid" src="images/toyotasupra.webp" alt="..."></div>
                    <div class="col-lg-6 p-0">
                        <div class="bg-black text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-left">
                                    <h4 class="text-white">Toyota Supra mk4</h4>
                                    <p class="mb-0 text-white-50">Ikona japońskiej motoryzacji z legendarnym silnikiem
                                        2JZ-GTE</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row gx-0 justify-content-center">
                    <div class="col-lg-6 p-0"><img class="w-100 img-fluid" src="images/9b0f19cb283a921d8f96e94856a556e7.jpg"
                            alt="..."></div>
                    <div class="col-lg-6 p-0 order-lg-first">
                        <div class="bg-black text-center h-100 project">
                            <div class="d-flex h-100">
                                <div class="project-text w-100 my-auto text-center text-lg-right">
                                    <h4 class="text-white">Nissan silvia s15</h4>
                                    <p class="mb-0 text-white-50">Legenda driftingu, auto powszechnie używane w najlepszych
                                        ligach międzykrajowych</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="bg-body-tertiary text-center bg-light footer sticky-bottom">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="eventListeners.js?v=<?php echo time() ?>" defer></script>

</body>

</html>