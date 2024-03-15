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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="styl.css?v=<?php echo time() ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-light navbar-expand-lg bg-body-tertiary">
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
    <section>
    <div class="row">
        <div class="col-12 col-sm-6">
            <h1>O nas</h1>
            <p class="text-justify">Jesteśmy firmą zajmującą się wynajmem samochodów. Nasza oferta obejmuje szeroki wybór samochodów dostosowanych do różnych potrzeb. W naszej ofercie znajdziesz zarówno samochody osobowe, jak i dostawcze. Wypożyczalnia samochodów Carrllix to gwarancja najwyższej jakości usług i konkurencyjnych cen. Zapraszamy do skorzystania z naszej oferty!</p>
        </div>
        <div class="col-12 col-sm-6">
            <img src="images/about.jpg" alt="about" class="img-fluid">
        </div>
    </div>
    </section>
    <footer class="bg-body-tertiary text-center bg-light footer sticky-bottom">
        <div class="container p-0 pb-0">
            <section class="">
            <!-- Facebook -->
            <a data-mdb-ripple-init class="btn text-white btn-floating m-1"
                style="background-color: #3b5998;"
                href="#!"
                role="button"
                ><i class="fab fa-facebook-f"></i
            ></a>

            <!-- Twitter -->
            <a
                data-mdb-ripple-init
                class="btn text-white btn-floating m-1"
                style="background-color: #55acee;"
                href="#!"
                role="button"
                ><i class="fab fa-twitter"></i
            ></a>

            <!-- Google -->
            <a
                data-mdb-ripple-init
                class="btn text-white btn-floating m-1"
                style="background-color: #dd4b39;"
                href="#!"
                role="button"
                ><i class="fab fa-google"></i
            ></a>

            <!-- Instagram -->
            <a
                data-mdb-ripple-init
                class="btn text-white btn-floating m-1"
                style="background-color: #ac2bac;"
                href="#!"
                role="button"
                ><i class="fab fa-instagram"></i
            ></a>

            <!-- Linkedin -->
            <a
                data-mdb-ripple-init
                class="btn text-white btn-floating m-1"
                style="background-color: #0082ca;"
                href="#!"
                role="button"
                ><i class="fab fa-linkedin-in"></i
            ></a>
            <!-- Github -->
            <a
                data-mdb-ripple-init
                class="btn text-white btn-floating m-1"
                style="background-color: #333333;"
                href="#!"
                role="button"
                ><i class="fab fa-github"></i
            ></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <div class="text-center p-3 " style="background-color: rgba(0, 0, 0, 0.05);">
            &copy; 2024 Copyright:
            <a class="text-body">zwirzaky</a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="eventListeners.js?v=<?php echo time() ?>" defer></script>

  </body>
</html>