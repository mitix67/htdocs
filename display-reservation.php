<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <link rel="stylesheet" href="calendar.css?v=<?php echo time() ?>">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <section class="row">
            <div class="col-12 p-4">

<?php

require_once 'functions.php';
require_once 'calendar.php';

if (isset($_SESSION['user_id'])) {
  if (isset($_GET['id'])) 
  {
      $conn = connectToDatabase();

      $reservations = querySelect($conn, "SELECT * FROM rezerwacje");

      $calendar = new Calendar();

      while ($row = $reservations->fetch_assoc()) 
      {
          if ($row['id_samochodu'] == $_GET['id'])
          {
              $startDate = new DateTime($row['data_rozpoczecia']);
              $endDate = new DateTime($row['data_zakonczenia']);
              $diff = $endDate->diff($startDate)->days;

              $brand = getDetailsById($conn, $row['id_samochodu'], 'marka');
              $model = getDetailsById($conn, $row['id_samochodu'], 'model');

              $combined = $brand . " " . $model;

              $calendar->add_event($combined, $row['data_rozpoczecia'], $diff, 'red');
          }
      }

      echo $calendar;

      closeConnection($conn);
  }
  else {
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
  // Handle the error or redirect the user
  exit;
}


?>
        </div>
    </section>
  </body>
</html>