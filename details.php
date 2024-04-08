<!doctype html>
<html lang="pl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="styl.css?v=<?php echo time() ?>" rel="stylesheet">
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
  <script src="https://kit.fontawesome.com/4ec8ec9cb4.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <?php
  session_start();
  if (isset ($_SESSION['user_id'])) {
    echo '<div class="navbar bg-body-tertiary">
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
  <?php require_once 'functions.php';
  $conn = connectToDatabase();

  if (isset ($_GET['id'])) {
    $id = $_GET['id'];
  } else {
    echo "Error: No id parameter provided.";
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
  <nav class="navbar navbar-light navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="images/logo.png" alt="logo" width="50" class="d-inline-block align-text-top">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor04"
        aria-controls="navbarColor04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarColor04">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Strona główna
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="search.php">Wyszukiwarka</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">O nas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Kontakt</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <a href="search.php">
    <div class="btn"><i class="fa-solid fa-arrow-left"></i></div>
  </a>
  <main>
    <section class="container mt-5">
      <div class="row">
        <div class="col-md-6">
          <div class="slider-container">
            <?php echo getImagesPathById($conn, $id); ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-6">
              <h2>
                <?php echo getDetailsById($conn, $id, 'marka');
                echo " ";
                echo getDetailsById($conn, $id, 'model'); ?>
              </h2>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p>
                <?php echo getDetailsById($conn, $id, 'opis'); ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h3>Historia</h3>
            <p>
              <?php echo getDetailsById($conn, $id, 'historia'); ?>
          </div>
          <div class="flex justify-content-center py-10 col-md-6">
            <table class="carPriceTable">
              <thead>
                <tr>
                  <th class="border-r border-gray-400">CZAS WYPOŻYCZENIA</th>
                  <th class="text-left">CENA</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <p>Doba (pon. - czw.)</p>
                  </td>
                  <td>
                    <?php echo getPricesById($conn, 'dobatyk', $id) ?> zł
                  </td>
                </tr>
                <tr>
                  <td>
                    <p>Doba weekendowa (pt. - ndz.)</p>
                  </td>
                  <td>
                    <?php echo getPricesById($conn, 'dobawek', $id) ?> zł
                  </td>
                </tr>
                <tr>
                  <td>
                    <p>Weekend (pt. 16:00 - pon. 10:00)</p>
                  </td>
                  <td>
                    <?php echo getPricesById($conn, 'weekend', $id) ?> zł
                  </td>
                </tr>
                <tr>
                  <td>
                    <p>Tydzień</p>
                  </td>
                  <td>
                    <?php echo getPricesById($conn, 'tydzien', $id) ?> zł
                  </td>
                </tr>
                <tr>
                  <td>
                    <p>Miesiąc</p>
                  </td>
                  <td>
                    <?php echo getPricesById($conn, 'miesiac', $id) ?> zł
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </section>
  </main>
  <footer class="bg-body-tertiary text-center footer sticky-bottom">
    <div class="container p-0 pb-0">
      <div class="">
        <!-- Facebook -->
        <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #3b5998;" href="#!"
          role="button"><i class="fab fa-facebook-f"></i></a>

        <!-- Twitter -->
        <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #55acee;" href="#!"
          role="button"><i class="fab fa-twitter"></i></a>

        <!-- Google -->
        <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #dd4b39;" href="#!"
          role="button"><i class="fab fa-google"></i></a>

        <!-- Instagram -->
        <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #ac2bac;" href="#!"
          role="button"><i class="fab fa-instagram"></i></a>

        <!-- Linkedin -->
        <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #0082ca;"
            href="https://www.linkedin.com/in/mateusz-burzy%C5%84ski-5ab71227a/" role="button"><i class="fab fa-linkedin-in"></i></a>
        <!-- Github -->
        <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #333333;"
            href="https://github.com/zwirzaky" role="button"><i class="fab fa-github"></i></a>
      </div>
      <!-- Section: Social media -->
    </div>
    <div class="text-center p-3 " style="background-color: rgba(0, 0, 0, 0.05);">
      &copy; 2024 Copyright:
      <a class="text-body">zwirzaky</a>
    </div>
  </footer>
  <script src="slider.js?v=<?php echo time() ?>"></script>
</body>

</html>