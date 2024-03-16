<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <link rel="stylesheet" href="calendar.css?v=<?php echo time() ?>">
        <title>Display Reservation</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
    <nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
  <div class="row w-100 border-bottom">
    <div class="col-6">
      <h2>Rezerwacje</h2>
    </div>
        <div class="col-6 d-flex justify-content-end">
            <a href="admin-panel.php"><div class="btn btn-primary">Wróć</div></a>
        </div>
</nav>

        <section class="row">
            <div class="col-12 p-4">
              <?php
              if (isset($_SESSION['user_id'])) {
                if (isset($_GET['id'])) 
                {
                    echo '
                      <button class="btn btn-primary" id="calendar-btn-left-display">Left</button>
                      <button class="btn btn-primary" data-id="'.$_GET['id'].'" id="calendar-btn-right-display">Right</button>'
                    ;
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
                <div id="display-panel-container">
                </div>
            </div>
        </div>
    </section>
    <script src="eventListeners.js"></script>
  </body>
</html>