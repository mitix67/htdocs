<!DOCTYPE html>
<html lang="pl">
    <head>
        <link rel="stylesheet" href="checkmark.css?v=<?php echo time() ?>">
    </head>
    <body>
<?php
require_once 'functions.php';

addReservationToDatabase();

function addReservationToDatabase() {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $adres = $_POST['adres'];
        $kod_pocztowy = $_POST['kod_pocztowy'];
        $miasto = $_POST['miasto'];

        $data_rozpoczecia = $_POST['data_rozpoczecia'];
        $data_zakonczenia = $_POST['data_zakonczenia'];
        $id_samochodu = $_POST['id_samochodu'];

        $conn = connectToDatabase();

        $stmt = mysqli_prepare($conn, 'INSERT INTO rezerwacje_dane (imie, nazwisko, tel, email, adres, kod_pocztowy, miasto) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt2 = mysqli_prepare($conn, 'INSERT INTO rezerwacje (data_rozpoczecia, data_zakonczenia, id_samochodu) VALUES (?, ?, ?)');

        mysqli_stmt_bind_param($stmt, 'sssssss', $imie, $nazwisko, $tel, $email, $adres, $kod_pocztowy, $miasto);
        mysqli_stmt_bind_param($stmt2, 'ssi', $data_rozpoczecia, $data_zakonczenia, $id_samochodu);

        if (mysqli_stmt_execute($stmt) && mysqli_stmt_execute($stmt2)) {
            // Success
            echo '<div class="success-checkmark">
                    <div class="check-icon">
                    <span class="icon-line line-tip"></span>
                    <span class="icon-line line-long"></span>
                    <div class="icon-circle"></div>
                    <div class="icon-fix"></div>
                    </div>
                </div>
                <center>
                    .'.
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
                    </script>";'.
                </center>
          ';
        } else {
            echo "Error adding reservation: " . mysqli_error($conn);
        }
        
        mysqli_close($conn);
    }
}
?>
    </body>
    <script>
        $("button").click(function () {
            $(".check-icon").hide();
            setTimeout(function () {
                $(".check-icon").show();
            }, 10);
        });
    </script>
</html>
