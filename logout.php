<?php
session_start();
if (isset($_SESSION['user_id']))
{
    $_SESSION = array();

    session_destroy();


    header("Location: login.php");
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