<!doctype html>
<html lang="pl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrllix</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="stylg.css?v=<?php echo time() ?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
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
                    <a class="nav-link active" href="#">Strona główna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Wyszukiwarka</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Cennik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">O nas</a>
                </li> 
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-sm-2" type="search" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Wyszukiwarka</h2>
                    <h3 class="section-subheading text-muted">Znajdź swoje wymarzone auto</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" name="marka" id="marka" type="text" placeholder="Marka" required="required" data-validation-required-message="Podaj markę samochodu." />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="model" id="model" type="text" placeholder="Model" required="required" data-validation-required-message="Podaj model samochodu." />
                                    <p class="help-block text-danger"></p>
                                </div>

                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                    <select class="form-control" name="skrzynia" id="skrzynia" required="required" data-validation-required-message="Wybierz napęd samochodu.">
                                        <option value="Manualna">Manualna</option>
                                        <option value="Automatyczna">Automatyczna</option>
                                    </select>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="naped" id="naped" required="required" data-validation-required-message="Wybierz napęd samochodu.">
                                        <option value="FWD">FWD</option>
                                        <option value="RWD">RWD</option>
                                        <option value="AWD">AWD</option>
                                    </select>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Wyślij</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Ładne kwadratowe kafelki z wynikami wyszukiwania -->
    <div class="container">
        <div class="row">
            

    
    <?php

    //klasa z kodem html do edycji
    


    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $host = "localhost";
        $nazwa = "root";
        $haslo = "";
        $baza = "wynajem";
        $polaczenie = new mysqli($host, $nazwa, $haslo, $baza);
        @$marka = $_POST['marka'];
        @$model = $_POST['model'];
        @$skrzynia = $_POST['skrzynia'];
        @$naped = $_POST['naped'];
        $sql = "SELECT * FROM samochody WHERE marka='$marka' AND model='$model' AND naped='$naped' AND skrzynia='$skrzynia'";
        $wynik = $polaczenie ->query($sql);
        while($wiersz = $wynik ->fetch_assoc()){
            echo '
            <div class="col-md-4">
                <div class="card">
                    <img src="images/'.$wiersz["sciezka"].'" class="card-img-top" alt="image of a car">
                    <div class="card-body pb-2">
                        <div class="row">
                            <div class="col m-1 d-flex align-items-center p-10 border rounded" style="height: 40px; font-size: 13px; color: #6c757d;">
                                <svg class="mx-2" width="20" height="20" fill="none" viewBox="0 0 24 24">
                                    <path d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="#12192C" stroke-width="1.5"></path><path d="M19 19L17.5 17.5" opacity="0.5" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path><path d="M19 5L17.5 6.5" opacity="0.5" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path><path d="M5 19L6.5 17.5" opacity="0.5" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path><path d="M5 5L6.5 6.5" opacity="0.5" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path><path d="M2 12H4" opacity="0.5" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path><path d="M19.9998 12L21.9998 12" opacity="0.5" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path><path d="M12 4.00021L12 2.00021" opacity="0.5" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path><path d="M10.1212 14.3639C8.94966 13.1923 8.94966 11.2928 10.1212 10.1212C11.2928 8.94966 13.1923 8.94966 14.3639 10.1212C14.8095 10.5669 15.1208 11.492 15.3354 12.4673C15.6563 13.9259 15.8167 14.6551 15.2359 15.2359C14.6551 15.8167 13.9259 15.6563 12.4673 15.3354C11.492 15.1208 10.5669 14.8095 10.1212 14.3639Z" stroke="#12192C" stroke-width="1.5"></path>
                                </svg>
                            '.$wiersz["czas"].' do 100 km/h
                            </div>
                            <div class="col m-1 d-flex align-items-center p-2 border rounded" style="height: 40px; font-size: 13px; color: #6c757d;">
                                <svg class="mx-2" width="20" height="20" fill="none" viewBox="0 0 24 24">
                                    <path d="M8 9V15" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path><path d="M12 9V15" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path><path d="M8 12H13C13.9319 12 14.3978 12 14.7654 11.8478C15.2554 11.6448 15.6448 11.2554 15.8478 10.7654C16 10.3978 16 9.93188 16 9" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path><rect height="20" opacity="0.5" rx="5" stroke="#12192C" stroke-width="1.5" width="20" x="2" y="2"></rect></svg>
                                </svg>
                            '.$wiersz["skrzynia"].'
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m-1 d-flex align-items-center p-10 border rounded" style="height: 40px; font-size: 13px; color: #6c757d;">
                                <svg class="mx-2" width="20" height="20" fill="none" viewBox="0 0 24 24">
                                    <path d="M13.926 9.70541C13.5474 9.33386 13.5474 8.74151 13.5474 7.55682V7.24712C13.5474 3.96249 13.5474 2.32018 12.6241 2.03721C11.7007 1.75425 10.711 3.09327 8.73167 5.77133L5.66953 9.91436C4.3848 11.6526 3.74244 12.5217 4.09639 13.205C4.10225 13.2164 4.10829 13.2276 4.1145 13.2387C4.48945 13.9117 5.59888 13.9117 7.81775 13.9117C9.05079 13.9117 9.6673 13.9117 10.054 14.2754" stroke="#12192C" stroke-width="1.5"></path><path d="M13.9259 9.70557L13.9459 9.72481C14.3326 10.0885 14.9492 10.0885 16.1822 10.0885C18.4011 10.0885 19.5105 10.0885 19.8854 10.7615C19.8917 10.7726 19.8977 10.7838 19.9036 10.7951C20.2575 11.4785 19.6151 12.3476 18.3304 14.0858L15.2682 18.2288C13.2888 20.9069 12.2991 22.2459 11.3758 21.9629C10.4524 21.68 10.4524 20.0376 10.4525 16.753L10.4525 16.4434C10.4525 15.2587 10.4525 14.6663 10.074 14.2948L10.054 14.2755" opacity="0.5" stroke="#12192C" stroke-width="1.5"></path>
                                </svg>
                                '.$wiersz["km"].' KM
                            </div>
                            <div class="col m-1 d-flex align-items-center p-2 border rounded" style="height: 40px; font-size: 13px; color: #6c757d;">
                                <svg class="mx-2" width="20" height="20" fill="none" viewBox="0 0 24 24">
                                    <path d="M16.5 22C18.9853 22 21 17.5228 21 12C21 6.47715 18.9853 2 16.5 2" stroke="#12192C" stroke-width="1.5"></path><path d="M12 12C12 17.5228 9.98528 22 7.5 22C5.01472 22 3 17.5228 3 12C3 6.47715 5.01472 2 7.5 2C9.98528 2 12 6.47715 12 12Z" stroke="#12192C" stroke-width="1.5"></path><path d="M7.5 2L16.5 2" stroke="#12192C" stroke-width="1.5"></path><path d="M7.5 22L16.5 22" stroke="#12192C" stroke-width="1.5"></path><path d="M9 12C9 15.3137 8.32843 18 7.5 18C6.67157 18 6 15.3137 6 12C6 8.68629 6.67157 6 7.5 6C8.32843 6 9 8.68629 9 12ZM9 12H8" opacity="0.5" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path>
                            </svg>
                            '.$wiersz["naped"].'
                            </div>
                        </div>
                        <div class="row d-flex align-items-center">
                            <div class="col">
                                Cena:
                            </div>
                            <div class="col d-flex justify-content-end align-items-center font-weight-bold" >
                                od '.$wiersz["cena"].' zł
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
        $polaczenie ->close();
    }
            ?>            </div>
            </div>
            </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>