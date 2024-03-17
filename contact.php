<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kontakt</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png">
    <!-- Font Awesome icons (free version)-->
    <script src="https://kit.fontawesome.com/4ec8ec9cb4.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="styl.css?v=<?php echo time() ?>" rel="stylesheet">
    <link href="calendar.css?v=<?php echo time() ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
<body>
<nav class="navbar navbar-light navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="images/logo.png" alt="" width="50" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor04" aria-controls="navbarColor04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor04">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Strona główna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="search.php">Wyszukiwarka</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">O nas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="contact.php">Kontakt</a>
                </li> 
            </div>
        </div>
    </nav>
    <header class="container-fluid" >
        <div class="row">
            <div class="col-12 w-100 p-0 m-0">
                <img class="w-100" style="height:300px; object-fit: cover;" src="images/bg2.jpg" alt="background">
            </div>
        </div>
    </header>
    <section class="container mt-3">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h1>Skontaktuj się z nami!</h1>
                <p class="text-justify">Chcesz zarezerwować samochód, uzyskać więcej informacji lub skonsultować szczegóły dotyczące naszych usług? Jesteśmy tutaj, aby Ci pomóc! Skorzystaj z jednego z poniższych sposobów kontaktu, aby się z nami skontaktować:</p>
                <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <div class="form-group">
                        <label for="name">Imię i nazwisko:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Wiadomość:</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Wyślij</button>
                </form>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $message = $_POST["message"];

                    $to = "your-email@example.com";
                    $subject = "New message from contact form";
                    $body = "Name: $name\nEmail: $email\nMessage: $message";
                    $headers = "From: $email";

                    if (@mail($to, $subject, $body, $headers)) {
                        echo "<p class='text-success'>Email sent successfully!</p>";
                    } else {
                        echo "<p class='text-danger'>Failed to send email. Please try again later.</p>";
                    }
                }
                ?>
            </div>
            <div class="col-12 col-sm-6">
                <div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Loreta%C5%84ska%2016+(Carrllix)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.gps.ie/">gps tracker sport</a></iframe></div>
            </div>
        </div>
    </section>
    <footer class="bg-body-tertiary text-center footer sticky-bottom">
        <div class="container p-0 pb-0">
            <section class="">
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
            </section>
            <!-- Section: Social media -->
        </div>
        <div class="text-center p-3 " style="background-color: rgba(0, 0, 0, 0.05);">
            &copy; 2024 Copyright:
            <a class="text-body">zwirzaky</a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>