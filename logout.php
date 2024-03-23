<!DOCTYPE html>
<html lang="pl">

<head>
  <link rel="stylesheet" href="error.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <?php
  session_start();
  if (isset ($_SESSION['user_id'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: login.php");
  } else {
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
    echo "<script>
            var count = 3;
            var countdown = setInterval(function() {
              count--;
              document.getElementById('countdown').innerHTML = 'Redirecting in: ' + count;
              if (count === 0) {
                clearInterval(countdown);
              }
            }, 1000);
          </script>";
    echo '
          </p>
        </div>
      </div>';
    exit;
  }
  ?>
</body>

</html>