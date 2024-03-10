<?php
session_start();

require_once 'functions.php';

if (isset($_SESSION['user_id']))
{
  if (isset($_GET['id']))
  {
      $conn = connectToDatabase();
      $id = $_GET['id'];
      $sql2 = "DELETE FROM rezerwacje WHERE id = $id";
      $sql3 = "DELETE FROM rezerwacje_dane WHERE id = $id";
      if ((querySelect($conn, $sql2) && querySelect($conn, $sql3)) === TRUE) {
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