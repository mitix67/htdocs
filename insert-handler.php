<!DOCTYPE html>
<html lang="pl">

<head>
    <link rel="stylesheet" href="checkmark.css?v=<?php echo time() ?>">
</head>

<body>
    <?php
    require_once 'functions.php';
    session_start();
    if (isset ($_SESSION['user_id'])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $marka = $_POST['marka'];
            $model = $_POST['model'];
            $opis = $_POST['opis'];
            $cena = $_POST['cena'];
            $rok_produkcji = $_POST['rok_produkcji'];
            $naped = $_POST['naped'];
            $km = $_POST['km'];
            $historia = $_POST['historia'];
            $skrzynia = $_POST['skrzynia'];
            $czas = $_POST['czas'];
            $dobatyk = $_POST['dobatyk'];
            $dobawek = $_POST['dobawek'];
            $weekend = $_POST['weekend'];
            $tydzien = $_POST['tydzien'];
            $miesiac = $_POST['miesiac'];
            $kolor = $_POST['kolor'];
            $imagesPath = $_FILES['imagesPath'];

            $conn = connectToDatabase();

            $baseQuery = "";
            $firstImage = "images/";
            // Handle the array of files
            $fileCount = count($imagesPath['name']);
            for ($i = 0; $i < $fileCount; $i++) {
                $fileName = $imagesPath['name'][$i];
                $fileTmpName = $imagesPath['tmp_name'][$i];
                $fileSize = $imagesPath['size'][$i];
                $fileError = $imagesPath['error'][$i];
                $fileType = $imagesPath['type'][$i];

                // Perform necessary file validations and processing
                // For example, you can move the uploaded file to a desired location
                // using move_uploaded_file() function
    

                if ($i == 0) {
                    $firstImage = $firstImage . $fileName;
                    $baseQuery = $firstImage . ";";
                    move_uploaded_file($fileTmpName, $firstImage);
                } else {
                    $uploadDirectory = "images/" . $marka . '/' . $model . '/';
                    $uploadedFilePath = $uploadDirectory . $fileName;

                    if (!file_exists($uploadDirectory)) {
                        mkdir($uploadDirectory, 0755, true);
                        $uploadDirectory = rawurlencode($uploadDirectory);
                    }

                    if (move_uploaded_file($fileTmpName, $uploadedFilePath)) {
                        echo "File uploaded successfully";
                    } else {
                        echo "Failed to upload file";
                    }
                    if ($i == 1) {
                        $baseQuery = $baseQuery . $uploadedFilePath;
                    } else {
                        $baseQuery = $baseQuery . ";" . $uploadedFilePath;
                    }
                }
            }

            echo $baseQuery;
            $baseQuery = rawurlencode($baseQuery);
            $query = "INSERT INTO samochody (marka, model, opis, sciezka, cena, rok_produkcji, naped, km, historia, kolor, skrzynia, czas) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $marka, $model, $opis, $firstImage, $cena, $rok_produkcji, $naped, $km, $historia, $kolor, $skrzynia, $czas);
            $result = mysqli_stmt_execute($stmt);

            $id = mysqli_insert_id($conn);

            $query2 = "INSERT INTO images (imagesPath, id_samochodu) VALUES (?, ?)";
            $stmt2 = mysqli_prepare($conn, $query2);
            mysqli_stmt_bind_param($stmt2, "si", $baseQuery, $id);
            $result2 = mysqli_stmt_execute($stmt2);

            $query3 = "INSERT INTO cennik (dobatyk, dobawek, weekend, tydzien, miesiac, id_samochodu) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt3 = mysqli_prepare($conn, $query3);
            mysqli_stmt_bind_param($stmt3, "sssssi", $dobatyk, $dobawek, $weekend, $tydzien, $miesiac, $id);
            $result3 = mysqli_stmt_execute($stmt3);

            if ($result && $result2 && $result3) {
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
                ;
            } else {
                echo '  
        <div class="container">
            <div class="circle-border"></div>
                <div class="circle">
                    <div class="error"></div>
                </div>
            </div>
        </div>'
                    . mysqli_error($conn);
            }

            closeConnection($conn);
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
      //document.getElementById("lolz").innerHTML = "";
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