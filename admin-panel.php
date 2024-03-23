<?php session_start();

if (!isset ($_SESSION['user_id'])) {
  include "style.php";
  header("refresh:3;url=index.php");
  echo '
    <div class="container1">
      <div class="circle-border"></div>
      <div class="circle">
        <div class="error"></div>
      </div>
      <div style="margin-top:150px;">
        <p class="text-danger">Error: You dont have access to this site.
        ';
  echo "<div id='countdown'>Redirecting in: 3</div>";
  echo '<script>
        //document.getElementById("lolz").innerHTML = "";
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
<!doctype html>
<html lang="pl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="calendar.css?v=<?php echo time() ?>">
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
      <div class="row w-100 border-bottom">
        <div class="col-12 col-md-6">
          <h2>Panel administracyjny</h2>
        </div>
        <div class="col-12 col-md-6 d-flex justify-content-end">
          <a href="index.php">
            <div class="btn btn-primary mr-1">Strona główna</div>
          </a>
          <a href="add-user.php">
            <div class="btn btn-primary mr-1">Dodaj użytkownika</div>
          </a>
          <a href="logout.php">
            <div class="btn btn-primary">Wyloguj się</div>
          </a>
        </div>
      </div>
    </div>
  </nav>
  <section class="container mt-4">
    <div class="row  justify-content-start">
      <div class="col-lg-6 col-12">
        <div class="container">
          <div class="row d-flex justify-content-start align-items-center" id="container">
            <h3>Rezerwacje</h3>
            <div class="container">
              <?php
              require_once 'calendar.php';
              $conn = connectToDatabase();

              generateDivsForReservationsInDatabase($conn);
              closeConnection($conn);
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-12">
        <div class="container">
          <div class="row d-flex justify-content-center align-items-center">
            <h3>Lista aut</h3>
            <div class="btn-group ml-auto">
              <a href="add-car.php" class="btn m-2 border border-success text-success">Dodaj auto</a>
            </div><br>
          </div>
        </div>
        <div id="carsList-container">
          <?php
          require_once 'functions.php';
          $conn = connectToDatabase();
          echo generateDivsForCarsInDatabase($conn);
          closeConnection($conn);
          ?>
        </div>
      </div>
    </div>
  </section>
  <section class="container">
    <div class="row">
      <div class="col-12">
        <button class="btn btn-primary" id="calendar-btn-left-admin">Poprzedni</button>
        <button class="btn btn-primary" id="calendar-btn-right-admin">Następny</button>
        <div id="admin-panel-container"></div>
      </div>
    </div>
  </section>
  <footer class="bg-body-tertiary text-center bg-light footer sticky-bottom">
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
        <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #0082ca;" href="#!"
          role="button"><i class="fab fa-linkedin-in"></i></a>
        <!-- Github -->
        <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #333333;" href="#!"
          role="button"><i class="fab fa-github"></i></a>
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