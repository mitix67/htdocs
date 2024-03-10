<?php
session_start();
require_once 'functions.php';

if(isset($_SESSION['user_id']))
{
  if (isset($_GET['id']))
  {
      $conn = connectToDatabase();
      $id = $_GET['id'];
      $sql2 = "DELETE FROM cennik WHERE id_samochodu = $id";
      $sql3 = "DELETE FROM images WHERE id_samochodu = $id";
      $sql = "DELETE FROM samochody WHERE id = $id";
      if ((querySelect($conn, $sql3) && querySelect($conn, $sql2) && querySelect($conn, $sql)) === TRUE) {
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
          exit;
      } 
      else 
      {
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