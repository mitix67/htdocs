<?php session_start(); 

if (!isset($_SESSION['user_id'])) {
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
<!DOCTYPE html>
<html lang="pl-pl">
<head>
    <title>Dodaj auto</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/4ec8ec9cb4.js" crossorigin="anonymous"></script>
</head>

    <body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <div class="row w-100 border-bottom">
                <div class="col-6">
                <h2>Dodaj auto</h2>
            </div>
        <div class="col-6 d-flex justify-content-end">
            <a href="admin-panel.php"><div class="btn btn-primary">Wróć</div></a>
        </div>
    </nav>
        <div class="container">
            <form action="insert-handler.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="marka">Marka</label>
                    <input type="text" class="form-control" id="marka" name="marka">
                </div>
                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" class="form-control" id="model" name="model">
                </div>
                <div class="form-group">
                    <label for="opis">Opis</label>
                    <textarea class="form-control" id="opis" name="opis"></textarea>
                </div>
                <div class="form-group">
                    <label for="cena">Cena</label>
                    <input type="text" class="form-control" id="cena" name="cena">
                </div>
                <div class="form-group">
                    <label for="rok_produkcji">Rok produkcji</label>
                    <input type="text" class="form-control" id="rok_produkcji" name="rok_produkcji">
                </div>
                <div class="form-group">
                    <label for="naped">Naped</label>
                    <input type="text" class="form-control" id="naped" name="naped">
                </div>
                <div class="form-group">
                    <label for="km">Km</label>
                    <input type="text" class="form-control" id="km" name="km">
                </div>
                <div class="form-group">
                    <label for="historia">Historia</label>
                    <textarea class="form-control" id="historia" name="historia"></textarea>
                </div>
                <div class="form-group">
                    <label for="skrzynia">Skrzynia</label>
                    <input type="text" class="form-control" id="skrzynia" name="skrzynia">
                </div>
                <div class="form-group">
                    <label for="czas">Czas</label>
                    <input type="text" class="form-control" id="czas" name="czas">
                </div>
                <div class="form-group">
                    <label for="dobatyk">Dobatyk</label>
                    <input type="text" class="form-control" id="dobatyk" name="dobatyk">
                </div>
                <div class="form-group">
                    <label for="dobawek">Dobawek</label>
                    <input type="text" class="form-control" id="dobawek" name="dobawek">
                </div>
                <div class="form-group">
                    <label for="weekend">Weekend</label>
                    <input type="text" class="form-control" id="weekend" name="weekend">
                </div>
                <div class="form-group">
                    <label for="tydzien">Tydzien</label>
                    <input type="text" class="form-control" id="tydzien" name="tydzien">
                </div>
                <div class="form-group">
                    <label for="miesiac">Miesiac</label>
                    <input type="text" class="form-control" id="miesiac" name="miesiac">
                </div>
                <div class="form-group" id="form-add-image-file-container">
                    <label for="imagesPath">Zdjęcie</label>
                    <input type="file" class="form-control" id="imagesPath" name="imagesPath[]">
                </div>
                <i class="fa-solid fa-plus"><button type="button" class="btn" id="form-add-image-file-field"></button></i>
                <button type="submit" class="btn btn-primary">Wyślij</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="eventListeners.js"></script>
    </body>
</html>