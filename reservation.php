<!DOCTYPE html>
<html lang="pl">

<head>
    <link rel="stylesheet" href="checkmark.css?v=<?php echo time() ?>">
</head>

<body>
    <?php
    require_once 'functions.php';

    addReservationToDatabase();

    function addReservationToDatabase()
    {

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
            $suma = $_POST['suma'];

            $conn = connectToDatabase();
            if ($suma == 0 || $id_samochodu == 0)
            {
                return mysqli_error($conn);
            }
            $stmt = mysqli_prepare($conn, 'INSERT INTO rezerwacje_dane (imie, nazwisko, tel, email, adres, kod_pocztowy, miasto) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $stmt2 = mysqli_prepare($conn, 'INSERT INTO rezerwacje (data_rozpoczecia, data_zakonczenia, naleznosc, id_samochodu) VALUES (?, ?, ?, ?)');

            mysqli_stmt_bind_param($stmt, 'sssssss', $imie, $nazwisko, $tel, $email, $adres, $kod_pocztowy, $miasto);
            mysqli_stmt_bind_param($stmt2, 'sssi', $data_rozpoczecia, $data_zakonczenia,$suma, $id_samochodu);

            if (mysqli_stmt_execute($stmt) && mysqli_stmt_execute($stmt2)) {
                echo '<div id="dis">';
                echo '<svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>';
                echo '</div>';
                header("refresh:3;url=search.php");
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
            } else {
                echo '  
            <div class="container">
                <div class="circle-border"></div>
                    <div class="circle">
                        <div class="error"></div>
                    </div>
                </div>
            </div>' . mysqli_error($conn);
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