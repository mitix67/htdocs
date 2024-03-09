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

    $samochodys = querySelect($conn, "SELECT * FROM rezerwacje");


    while ($row = $samochodys->fetch_assoc()) {
        if ($row['id'] == $_GET['id'])
            {
                // Retrieve values from the database
                $id = $_GET['id'];
                $conn = connectToDatabase();
                $rezerwacje = querySelect($conn, "SELECT * FROM rezerwacje WHERE id = $id")->fetch_assoc();
                $rezerwacje_dane = querySelect($conn, "SELECT * FROM rezerwacje_dane WHERE id = $id")->fetch_assoc();

                // Generate form fields with values
                echo "<section class='container'>";
                echo "<div class='row'>";
                echo "<div class='col-6'>";
                echo "<h2>Aktualne wartości</h2>";

                echo "<form method='POST' action='update-car.php'>";
                echo "<input type='hidden' name='id' value='" . $_GET['id'] . "'>";

                echo "<div class='form-group'>";
                echo "<label for='imie'>Imię:</label>";
                echo "<input type='text' name='imie' id='imie' value='" . $rezerwacje_dane['imie'] . "' readonly required class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='nazwisko'>Nazwisko:</label>";
                echo "<input type='text' name='nazwisko' id='nazwisko' value='" . $rezerwacje_dane['nazwisko'] . "' readonly required class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='tel'>Telefon:</label>";
                echo "<input type='tel' name='tel' id='tel' value='" . $rezerwacje_dane['tel'] . "' readonly required class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='email'>Email:</label>";
                echo "<input type='email' name='email' id='email' value='" . $rezerwacje_dane['email'] . "' readonly required class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='adres'>Adres:</label>";
                echo "<input type='text' name='adres' id='adres' value='" . $rezerwacje_dane['adres'] . "' readonly required class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='kod_pocztowy'>Kod pocztowy:</label>";
                echo "<input type='text' name='kod_pocztowy' id='kod_pocztowy' value='" . $rezerwacje_dane['kod_pocztowy'] . "' readonly required class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='miasto'>Miasto:</label>";
                echo "<input type='text' name='miasto' id='miasto' value='" . $rezerwacje_dane['miasto'] . "' readonly required class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='data_rozpoczecia'>Data rozpoczęcia:</label>";
                echo "<input type='date' name='data_rozpoczecia' id='data_rozpoczecia' value='" . $rezerwacje['data_rozpoczecia'] . "' readonly required class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='data_zakonczenia'>Data zakończenia:</label>";
                echo "<input type='date' name='data_zakonczenia' id='data_zakonczenia' value='" . $rezerwacje['data_zakonczenia'] . "' readonly required class='form-control'>";
                echo "</div>";
                echo "</form>";
                echo "</div>";

                echo "<div class='col-6'>";
                echo "<h2>Aktualne wartości</h2>";

                echo "<form method='POST' action='update-reservation.php'>";
                echo "<input type='hidden' name='id' value='" . $_GET['id'] . "'>";

                echo "<div class='form-group'>";
                echo "<label for='imie'>Imię:</label>";
                echo "<input type='text' name='imie' id='imie' value='" . $rezerwacje_dane['imie'] . "' required class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='nazwisko'>Nazwisko:</label>";
                echo "<input type='text' name='nazwisko' id='nazwisko' value='" . $rezerwacje_dane['nazwisko'] . "' required class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='tel'>Telefon:</label>";
                echo "<input type='tel' name='tel' id='tel' value='" . $rezerwacje_dane['tel'] . "' required class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='email'>Email:</label>";
                echo "<input type='email' name='email' id='email' value='" . $rezerwacje_dane['email'] . "' required class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='adres'>Adres:</label>";
                echo "<input type='text' name='adres' id='adres' value='" . $rezerwacje_dane['adres'] . "' required class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='kod_pocztowy'>Kod pocztowy:</label>";
                echo "<input type='text' name='kod_pocztowy' id='kod_pocztowy' value='" . $rezerwacje_dane['kod_pocztowy'] . "' required class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='miasto'>Miasto:</label>";
                echo "<input type='text' name='miasto' id='miasto' value='" . $rezerwacje_dane['miasto'] . "' required class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='data_rozpoczecia'>Data rozpoczęcia:</label>";
                echo "<input type='date' name='data_rozpoczecia' id='data_rozpoczecia' value='" . $rezerwacje['data_rozpoczecia'] . "' required class='form-control'>";
                echo "</div>";

                echo "<div class='form-group'>";
                echo "<label for='data_zakonczenia'>Data zakończenia:</label>";
                echo "<input type='date' name='data_zakonczenia' id='data_zakonczenia' value='" . $rezerwacje['data_zakonczenia'] . "' required class='form-control'>";
                echo "</div>";

                echo "<button type='submit' name='submit' class='btn btn-primary'>Update</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "</section>";

                // heres 'cennik' table


        }
    }

    closeConnection($conn);
}
else if (isset($_POST['submit'])) {
    // Retrieve values from the form

    $id = $_POST['id'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $adres = $_POST['adres'];
    $kod_pocztowy = $_POST['kod_pocztowy'];
    $miasto = $_POST['miasto'];
    $data_rozpoczecia = $_POST['data_rozpoczecia'];
    $data_zakonczenia = $_POST['data_zakonczenia'];


    // Update the values in the database
    $conn = connectToDatabase();

    $query = "UPDATE rezerwacje_dane SET imie = '$imie', nazwisko = '$nazwisko', tel = '$tel', email = '$email', adres = '$adres', kod_pocztowy = '$kod_pocztowy', miasto = '$miasto' WHERE id = $id";
    $query2 = "UPDATE rezerwacje SET data_rozpoczecia = '$data_rozpoczecia', data_zakonczenia = '$data_zakonczenia' WHERE id = $id";

    $result = querySelect($conn, $query);
    $resul2 = querySelect($conn, $query2);
    closeConnection($conn);

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