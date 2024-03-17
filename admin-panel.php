<?php session_start(); 

if (!isset($_SESSION['user_id'])) {
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
    <link rel="stylesheet" href="calendar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
  <div class="row w-100 border-bottom">
    <div class="col-12 col-md-6">
      <h2>Panel administracyjny</h2>
    </div>
        <div class="col-12 col-md-6 d-flex justify-content-end">
            <a href="add-user.php"><div class="btn btn-primary mr-1">Dodaj użytkownika</div></a>
            <a href="logout.php"><div class="btn btn-primary">Wyloguj się</div></a>
        </div>
</nav>
<section class="container mt-4">
    </div>
    <div class="container">
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
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <button class="btn btn-primary" id="calendar-btn-left-admin">Poprzedni</button>
            <button class="btn btn-primary" id="calendar-btn-right-admin">Następny</button>
            <div >
              <div id="admin-panel-container">

              </div>
            </div>
</section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="eventListeners.js?v=<?php echo time() ?>" defer></script>
  </body>
</html>