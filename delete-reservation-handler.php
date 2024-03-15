<?php
session_start();

require_once 'functions.php';

if (isset($_SESSION['user_id']))
{
  if (isset($_GET['id']))
  {
      $conn = connectToDatabase();
      $id = $_GET['id'];

      $sql2 = "DELETE FROM rezerwacje WHERE id = ?";
      $sql3 = "DELETE FROM rezerwacje_dane WHERE id = ?";

      $stmt2 = $conn->prepare($sql2);
      $stmt2->bind_param("i", $id);
      $stmt2->execute();

      $stmt3 = $conn->prepare($sql3);
      $stmt3->bind_param("i", $id);
      $stmt3->execute();

      if ($stmt2->affected_rows > 0 && $stmt3->affected_rows > 0) {
          echo "Values deleted successfully.";
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
            closeConnection($conn);
          exit;
      } 
    }
    else{
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
} 
else 
{
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