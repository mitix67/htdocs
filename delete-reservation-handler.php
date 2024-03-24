<!DOCTYPE html>
<html lang="pl">

<head>
  <link rel="stylesheet" href="checkmark.css?v=<?php echo time() ?>">
</head>

<body>
  <?php
  session_start();

  require_once 'functions.php';

  if (isset ($_SESSION['user_id'])) {
    if (isset ($_GET['id'])) {
      $conn = connectToDatabase();
      $id = $_GET['id'];

      $sql2 = "DELETE FROM rezerwacje WHERE id = ?";
      $sql3 = "DELETE FROM rezerwacje_dane WHERE id_rezerwacji = ?";

      $stmt2 = $conn->prepare($sql2);
      $stmt2->bind_param("i", $id);
      $stmt2->execute();

      $stmt3 = $conn->prepare($sql3);
      $stmt3->bind_param("i", $id);
      $stmt3->execute();

      if ($stmt2->affected_rows > 0 && $stmt3->affected_rows > 0) {
        echo '<svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>';
        header("refresh:3;url=admin-panel.php");
        // echo "<div id='countdown'>Redirecting in: 5</div>";
        echo "<script>
              var count = 5;
              var countdown = setInterval(function() {
                count--;
                //document.getElementById('countdown').innerHTML = 'Redirecting in: ' + count;
                if (count === 0) {
                  clearInterval(countdown);
                }
              }, 1000);
            </script>";
        closeConnection($conn);
        exit;
      }
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

</body>

</html>