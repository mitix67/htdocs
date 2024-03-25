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

      $SQL7 = "SELECT * FROM rezerwacje WHERE id_samochodu = ?";
      $stmt6 = $conn->prepare($SQL7);
      $stmt6->bind_param("i", $id);
      $stmt6->execute();
      $id_rezerwacji = $stmt6->get_result()->fetch_assoc()['id'];

      
      $sql4 = "DELETE FROM rezerwacje WHERE id_samochodu = ?";
      $sql5 = "DELETE FROM rezerwacje_dane WHERE id_rezerwacji = ?";

      $stmt4 = $conn->prepare($sql4);
      $stmt4->bind_param("i", $id);
      $stmt4->execute();

      $stmt5 = $conn->prepare($sql5);
      $stmt5->bind_param("i", $id_rezerwacji);
      $stmt5->execute();

      $sql2 = "DELETE FROM cennik WHERE id_samochodu = ?";
      $sql3 = "DELETE FROM images WHERE id_samochodu = ?";
      $sql = "DELETE FROM samochody WHERE id = ?";

      $stmt = $conn->prepare($sql2);
      $stmt->bind_param("i", $id);
      $stmt->execute();

      $stmt = $conn->prepare($sql3);
      $stmt->bind_param("i", $id);
      $stmt->execute();

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("i", $id);
      $stmt->execute();

      if ($stmt->affected_rows > 0) {
        echo '<div id="dis">';
        echo '<svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>';
        echo '</div>';
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
        exit;
      } else {
        echo "Error deleting values.";
      }

    } else {
      echo "Error: No id parameter provided.";
      header("refresh:5;url=admin-panel.php");
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
    closeConnection($conn);
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
  }

  ?>

</body>

</html>