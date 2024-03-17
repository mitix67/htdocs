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
    </div>
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
                    <select class="form-control" id="naped" name="naped">
                        <option value="AWD">AWD</option>
                        <option value="FWD">FWD</option>
                        <option value="RWD">RWD</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="km">Km</label>
                    <input type="text" class="form-control" id="km" name="km">
                </div>
                <div class="form-group">
                    <label for="historia">Historia </label>
                    <p class="text-danger">*pisać w formacie HTML!!!</p>
                    <textarea class="form-control" id="historia" name="historia"></textarea>
                </div>
                <div class="form-group">
                    <label for="skrzynia">Skrzynia</label>
                    <select class="form-control" id="skrzynia" name="skrzynia">
                        <option value="Manualna">Manualna</option>
                        <option value="Automatyczna">Automatyczna</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="czas">Czas</label>
                    <input type="text" class="form-control" id="czas" name="czas">
                </div>
                <div class="form-group">
                    <label for="dobatyk">Cena za dobę tygoniową</label>
                    <input type="text" class="form-control" id="dobatyk" name="dobatyk">
                </div>
                <div class="form-group">
                    <label for="dobawek">Cena za dobę weekendową</label>
                    <input type="text" class="form-control" id="dobawek" name="dobawek">
                </div>
                <div class="form-group">
                    <label for="weekend">Cena za Weekend</label>
                    <input type="text" class="form-control" id="weekend" name="weekend">
                </div>
                <div class="form-group">
                    <label for="tydzien">Cena za Tydzien</label>
                    <input type="text" class="form-control" id="tydzien" name="tydzien">
                </div>
                <div class="form-group">
                    <label for="miesiac">Cena za Miesiac</label>
                    <input type="text" class="form-control" id="miesiac" name="miesiac">
                </div>
                <button type="button" class="btn" id="form-add-image-file-field"><i class="fa-solid fa-plus"></i></button>
                <div class="form-group" id="form-add-image-file-container">
                    <label for="imagesPath">Zdjęcie</label>
                    
                    <input type="file" class="form-control" id="imagesPath" name="imagesPath[]">
                </div>
                <button type="submit" class="btn btn-primary">Wyślij</button>
            </form>
        </div>
        <footer class="bg-body-tertiary text-center bg-light footer sticky-bottom">
        <div class="container p-0 pb-0">
            <div class="">
            <!-- Facebook -->
            <a data-mdb-ripple-init class="btn text-white btn-floating m-1"
                style="background-color: #3b5998;"
                href="#!"
                role="button"
                ><i class="fab fa-facebook-f"></i
            ></a>

            <!-- Twitter -->
            <a
                data-mdb-ripple-init
                class="btn text-white btn-floating m-1"
                style="background-color: #55acee;"
                href="#!"
                role="button"
                ><i class="fab fa-twitter"></i
            ></a>

            <!-- Google -->
            <a
                data-mdb-ripple-init
                class="btn text-white btn-floating m-1"
                style="background-color: #dd4b39;"
                href="#!"
                role="button"
                ><i class="fab fa-google"></i
            ></a>

            <!-- Instagram -->
            <a
                data-mdb-ripple-init
                class="btn text-white btn-floating m-1"
                style="background-color: #ac2bac;"
                href="#!"
                role="button"
                ><i class="fab fa-instagram"></i
            ></a>

            <!-- Linkedin -->
            <a
                data-mdb-ripple-init
                class="btn text-white btn-floating m-1"
                style="background-color: #0082ca;"
                href="#!"
                role="button"
                ><i class="fab fa-linkedin-in"></i
            ></a>
            <!-- Github -->
            <a
                data-mdb-ripple-init
                class="btn text-white btn-floating m-1"
                style="background-color: #333333;"
                href="#!"
                role="button"
                ><i class="fab fa-github"></i
            ></a>
            </div>
            <!-- Section: Social media -->
        </div>
        <div class="text-center p-3 " style="background-color: rgba(0, 0, 0, 0.05);">
            &copy; 2024 Copyright:
            <a class="text-body">zwirzaky</a>
        </div>
    </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="eventListeners.js"></script>
    </body>
</html>