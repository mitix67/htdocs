<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <link rel="stylesheet" href="calendar.css?v=<?php echo time() ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Rezerwacja</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar bg-body-tertiary" id="lolz">
    <div class="container-fluid">
      <div class="row w-100 border-bottom">
        <div class="col-6">
          <h2>Rezerwacje</h2>
        </div>
        <div class="col-6 d-flex justify-content-end">
          <a href="admin-panel.php">
            <div class="btn btn-primary">Wróć</div>
          </a>
        </div>
      </div>
    </div>
  </nav>
  <div class="row">
    <div class="col-12 p-4">
      <?php
      if (isset ($_SESSION['user_id'])) {
        if (isset ($_GET['id'])) {
          echo '
            <button class="btn btn-primary" id="calendar-btn-left-display">Poprzedni</button>
            <button class="btn btn-primary" data-id="' . $_GET['id'] . '" id="calendar-btn-right-display">Następny</button>'
          ;
        } else {
          include "style.php";
          header("refresh:3;url=admin-panel.php");
          echo '
            <div class="container1">
              <div class="circle-border"></div>
              <div class="circle">
                <div class="error"></div>
              </div>
              <div style="margin-top:150px;">
                <p class="text-danger">Error: No id parameter provided.
                ';
          echo "<div id='countdown'>Redirecting in: 3</div>";
          echo '<script>
              document.getElementById("lolz").innerHTML = "";
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
      } else {
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
                document.getElementById("lolz").innerHTML = "";
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
      <div id="display-panel-container">
      </div>
    </div>
  </div>
  <script src="eventListeners.js"></script>
</body>

</html>