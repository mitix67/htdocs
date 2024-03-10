<!DOCTYPE html>
<html lang="pl">
    <head>
        <link rel="stylesheet" href="calendar.css?v=<?php echo time() ?>">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <section class="row">
            <div class="col-12 p-4">

<?php

require_once 'functions.php';

if (isset($_GET['id'])) 
{
    $conn = connectToDatabase();

    $stmt = $conn->prepare("SELECT * FROM samochody");
    $stmt->execute();
    $samochodys = $stmt->get_result();


    while ($row = $samochodys->fetch_assoc()) {
        if ($row['id'] == $_GET['id'])
            {
                // Retrieve values from the database
                $id = $_GET['id'];
                $conn = connectToDatabase();
                $id = $_GET['id'];

                $stmt = $conn->prepare("SELECT * FROM samochody WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $samochody = $stmt->get_result()->fetch_assoc();

                $stmt = $conn->prepare("SELECT * FROM cennik WHERE id_samochodu = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $cennik = $stmt->get_result()->fetch_assoc();

                // Generate form fields with values
                echo "<section class='container'>";
                echo "<div class='row'>";
                echo "<div class='col-6'>";
                echo "<h2>Aktualne wartości</h2>";
                echo "";

                echo "<form method='POST' action='update-car.php'>";
                echo "<input type='hidden' name='id' value='" . $_GET['id'] . "'>";

                echo "<div class='form-group'>";
                echo "<label for='marka'>Marka:</label>";
                echo "<input type='text' name='marka' id='marka' value='" . $samochody['marka'] . "' class='form-control' readonly>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='model'>Model:</label>";
                echo "<input type='text' name='model' id='model' value='" . $samochody['model'] . "' class='form-control' readonly>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='opis'>Opis:</label>";
                echo "<textarea name='opis' id='opis' class='form-control' readonly>" . $samochody['opis'] . "</textarea>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='sciezka'>Sciezka:</label>";
                echo "<input type='text' name='sciezka' id='sciezka' value='" . $samochody['sciezka'] . "' class='form-control' readonly>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='cena'>Cena:</label>";
                echo "<input type='text' name='cena' id='cena' value='" . $samochody['cena'] . "' class='form-control' readonly>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='rok_produkcji'>Rok produkcji:</label>";
                echo "<input type='text' name='rok_produkcji' id='rok_produkcji' value='" . $samochody['rok_produkcji'] . "' class='form-control' readonly>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='naped'>Naped:</label>";
                echo "<input type='text' name='naped' id='naped' value='" . $samochody['naped'] . "' class='form-control' readonly>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='km'>KM:</label>";
                echo "<input type='text' name='km' id='km' value='" . $samochody['km'] . "' class='form-control' readonly>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='historia'>Historia:</label>";
                echo "<textarea name='historia' id='historia' class='form-control' readonly>" . $samochody['historia'] . "</textarea>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='skrzynia'>Skrzynia:</label>";
                echo "<input type='text' name='skrzynia' id='skrzynia' value='" . $samochody['skrzynia'] . "' class='form-control' readonly>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='czas'>Czas:</label>";
                echo "<input type='text' name='czas' id='czas' value='" . $samochody['czas'] . "' class='form-control' readonly>";

                echo "<h3 class='m-2'>Cennik</h3>";

                echo "<div class='form-group'>";
                echo "<label for='dobatyk'>Dobatyk:</label>";
                echo "<input type='text' name='dobatyk' id='dobatyk' value='" . $cennik['dobatyk'] . "' class='form-control' readonly>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='dobawek'>Dobawek:</label>";
                echo "<input type='text' name='dobawek' id='dobawek' value='" . $cennik['dobawek'] . "' class='form-control' readonly>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='weekend'>Weekend:</label>";
                echo "<input type='text' name='weekend' id='weekend' value='" . $cennik['weekend'] . "' class='form-control' readonly>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='tydzien'>Tydzien:</label>";
                echo "<input type='text' name='tydzien' id='tydzien' value='" . $cennik['tydzien'] . "' class='form-control' readonly>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='miesiac'>Miesiac:</label>";
                echo "<input type='text' name='miesiac' id='miesiac' value='" . $cennik['miesiac'] . "' class='form-control' readonly>";
                echo "</div>";

                echo "</div>";
                echo "</form>";

                echo "</form>";
                echo "</div>";
                echo "<div class='col-6'>";
                echo "<h2>Edytuj właściwość</h2>";
                echo "<form method='post' action='update-car.php'>";
                echo "<input type='hidden' name='id' value='" . $_GET['id'] . "'>";

                echo "<div class='form-group'>";
                echo "<label for='marka'>Marka:</label>";
                echo "<input type='text' name='marka' id='marka' value='" . $samochody['marka'] . "' class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='model'>Model:</label>";
                echo "<input type='text' name='model' id='model' value='" . $samochody['model'] . "' class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='opis'>Opis:</label>";
                echo "<textarea name='opis' id='opis' class='form-control'>" . $samochody['opis'] . "</textarea>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='sciezka'>Sciezka:</label>";
                echo "<input type='text' name='sciezka' id='sciezka' value='" . $samochody['sciezka'] . "' class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='cena'>Cena:</label>";
                echo "<input type='text' name='cena' id='cena' value='" . $samochody['cena'] . "' class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='rok_produkcji'>Rok produkcji:</label>";
                echo "<input type='text' name='rok_produkcji' id='rok_produkcji' value='" . $samochody['rok_produkcji'] . "' class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='naped'>Naped:</label>";
                echo "<input type='text' name='naped' id='naped' value='" . $samochody['naped'] . "' class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='km'>KM:</label>";
                echo "<input type='text' name='km' id='km' value='" . $samochody['km'] . "' class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='historia'>Historia:</label>";
                echo "<textarea name='historia' id='historia' class='form-control'>" . $samochody['historia'] . "</textarea>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='skrzynia'>Skrzynia:</label>";
                echo "<input type='text' name='skrzynia' id='skrzynia' value='" . $samochody['skrzynia'] . "' class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='czas'>Czas:</label>";
                echo "<input type='text' name='czas' id='czas' value='" . $samochody['czas'] . "' class='form-control'>";
                
                echo "<h3 class='m-2'>Cennik</h3>";

                echo "<div class='form-group'>";
                echo "<label for='dobatyk'>Dobatyk:</label>";
                echo "<input type='text' name='dobatyk' id='dobatyk' value='" . $cennik['dobatyk'] . "' class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='dobawek'>Dobawek:</label>";
                echo "<input type='text' name='dobawek' id='dobawek' value='" . $cennik['dobawek'] . "' class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='weekend'>Weekend:</label>";
                echo "<input type='text' name='weekend' id='weekend' value='" . $cennik['weekend'] . "' class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='tydzien'>Tydzien:</label>";
                echo "<input type='text' name='tydzien' id='tydzien' value='" . $cennik['tydzien'] . "' class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='miesiac'>Miesiac:</label>";
                echo "<input type='text' name='miesiac' id='miesiac' value='" . $cennik['miesiac'] . "' class='form-control'>";
                echo "</div>";

                echo "<button type='submit' name='submit' class='btn btn-primary'>Update</button>";
                echo "</form>";
                echo "</section>";
                echo "</div>";
        }
    }

    closeConnection($conn);
}
else if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $marka = $_POST['marka'];
    $model = $_POST['model'];
    $opis = $_POST['opis'];
    $sciezka = $_POST['sciezka'];
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

    $conn = connectToDatabase();
    $query = "UPDATE samochody SET marka=?, model=?, opis=?, sciezka=?, cena=?, rok_produkcji=?, naped=?, km=?, historia=?, skrzynia=?, czas=? WHERE id=?";
    $query2 = "UPDATE cennik SET dobatyk=?, dobawek=?, weekend=?, tydzien=?, miesiac=? WHERE id_samochodu=?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssssi", $marka, $model, $opis, $sciezka, $cena, $rok_produkcji, $naped, $km, $historia, $skrzynia, $czas, $id);
    $result = $stmt->execute();
    
    $stmt2 = $conn->prepare($query2);
    $stmt2->bind_param("sssssi", $dobatyk, $dobawek, $weekend, $tydzien, $miesiac, $id);
    $resul2 = $stmt2->execute();
    
    if ($result && $resul2) {
        echo "Values updated successfully.";
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
    } else {
        echo "Error updating values.";
    }
    
    closeConnection($conn);
}
else
{
    echo "Error: No id parameter provided.";
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
        </div>
    </section>
  </body>
</html>
<?php

?>