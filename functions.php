<?php

function connectToDatabase() {
    $host = "127.0.0.1";
    $nazwa = "s168691";
    $haslo = "myoXJ7fsql";
    $baza = "s168691";
    $conn = new mysqli($host, $nazwa, $haslo, $baza);
    // Check connection

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Return the connection object
    return $conn;
}

function closeConnection($conn) {
    $conn->close();
}

function querySelect($conn, $sql) {
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing query: " . $conn->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        die("Error executing query: " . $stmt->error);
    }

    return $result;

}

function generateAllCards($conn) {
    $sql = "SELECT * FROM samochody";
    $result = querySelect($conn, $sql);

    return generateCard($result);
}

function generateSelectFromBrand($conn) {
    $sql = "SELECT marka FROM samochody GROUP BY marka ORDER BY marka ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $select = "<option value=''>Wybierz markę</option>";
    foreach ($result as $row) {
        $brand = $row['marka'];
        if ($brand == null)
            return null;

        $select .= "<option value='$brand'>$brand</option>";
    }

    return $select;
}

function generateSelectFromModel($conn, $brand) {
    $sql = "SELECT model FROM samochody WHERE marka=? GROUP BY model ORDER BY model ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $brand);
    $stmt->execute();
    $result = $stmt->get_result();

    $select = "<option value=''>Wybierz model</option>";
    
    foreach ($result as $row) {
        $model = $row['model'];
        $select .= "<option value='$model'>$model</option>";
    }

    return $select;
}

// Handler for functions.php?brand

if (isset($_GET['brand'])) {
    $conn = connectToDatabase();
    $brand = $_GET['brand'];

    if ($brand == "0")
    {   
        $conn = connectToDatabase();
        echo generateAllCards($conn);
        closeConnection($conn);
    }   
    else{
        $selectFromModel = generateSelectFromModel($conn, $brand);
        closeConnection($conn);
        echo $selectFromModel;
    }
}


function generateCard($wynik) 
{
    while($wiersz = $wynik ->fetch_assoc()){
        echo '
        <div class="col-md-4 mt-3">
            <div class="card">
                <img src="'.$wiersz["sciezka"].'" id="id='.$wiersz["id"].'" class="card-img-top" alt="image of a car">
                <div class="card-header pb-0">
                    <h5 class="card-title">'.$wiersz["marka"].' '.$wiersz["model"].'</h5>
                </div>
                <div class="card-body pb-2 pt-2">
                    <div class="row">
                        <div class="col m-1 d-flex align-items-center p-10 border rounded" style="height: 40px; font-size: 13px; color: #6c757d;">
                        <svg class="mx-2" width="20" height="20" fill="none" viewBox="0 0 24 24">
                            <path d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="#12192C" stroke-width="1.5"></path>
                            <path d="M19 19L17.5 17.5" opacity="0.5" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path>
                            <path d="M19 5L17.5 6.5" opacity="0.5" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path>
                            <path d="M5 19L6.5 17.5" opacity="0.5" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path>
                            <path d="M5 5L6.5 6.5" opacity="0.5" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path>
                            <path d="M2 12H4" opacity="0.5" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path>
                            <path d="M19.9998 12L21.9998 12" opacity="0.5" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path>
                            <path d="M12 4.00021L12 2.00021" opacity="0.5" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path>
                            <path d="M10.1212 14.3639C8.94966 13.1923 8.94966 11.2928 10.1212 10.1212C11.2928 8.94966 13.1923 8.94966 14.3639 10.1212C14.8095 10.5669 15.1208 11.492 15.3354 12.4673C15.6563 13.9259 15.8167 14.6551 15.2359 15.2359C14.6551 15.8167 13.9259 15.6563 12.4673 15.3354C11.492 15.1208 10.5669 14.8095 10.1212 14.3639Z" stroke="#12192C" stroke-width="1.5"></path>
                        </svg>
                        '.$wiersz["czas"].' do 100 km/h
                        </div>
                        <div class="col m-1 d-flex align-items-center p-2 border rounded" style="height: 40px; font-size: 13px; color: #6c757d;">
                        <svg class="mx-2" width="20" height="20" fill="none" viewBox="0 0 24 24">
                            <path d="M8 9V15" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path>
                            <path d="M12 9V15" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path>
                            <path d="M8 12H13C13.9319 12 14.3978 12 14.7654 11.8478C15.2554 11.6448 15.6448 11.2554 15.8478 10.7654C16 10.3978 16 9.93188 16 9" stroke="#12192C" stroke-linecap="round" stroke-width="1.5"></path>
                            <rect height="20" opacity="0.5" rx="5" stroke="#12192C" stroke-width="1.5" width="20" x="2" y="2"></rect>
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
                    <div class="row mt-1 d-flex align-items-center">
                        <div class="col">
                            Cena:
                        </div>
                        <div class="col d-flex justify-content-end align-items-center font-weight-bold" >
                            od '.$wiersz["cena"].' zł
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <a href="details.php?id='.$wiersz["id"].'"><div class="btn btn-primary btn-block">Szczegóły</div></a>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <button class="btn btn-success btn-block" onclick="setReservationOverlay(this,'.$wiersz["id"].')">Rezerwuj</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
    }
}

function getDetailsById($conn, $id, $detail)
{
    $stmt = $conn->prepare("SELECT $detail FROM samochody WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row[$detail];
    } 
    else {
        return null;
    }
}


//function to get path to 3 images, you must join them by 'id' tables: samochody and images
function getImagesPathById($conn, $id) 
{
    $stmt = $conn->prepare("SELECT * FROM images WHERE id_samochodu = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $brand = getDetailsById($conn, $id, 'marka');
    $model = getDetailsById($conn, $id, 'model');
    
    //$directory = "images/".$brand."/".$model."/";

    if ($result->num_rows > 0) {
        while($wiersz = $result -> fetch_assoc())
        {
            $path = $wiersz['imagesPath'];
            $path = str_replace("%2F", "/", $path);
            $image = explode("%3B", $path);

            $count = count($image);
            $i = 0;
            while($i < $count)
            {
                echo '
                    <img src="'.$image[$i].'" alt="Image '.$i.'" class="slider-container-img">';
                $i++;
            }
        }
    } 
    else {
        return null;
    }
}

function getPricesById($conn,$price, $id) {
    $stmt = $conn->prepare("SELECT * FROM cennik WHERE id_samochodu = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row[$price];
    } 
    else {
        return null;
    }
}

function generateDivsForCarsInDatabase($conn) {
    $sql = "SELECT * FROM samochody";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while($wiersz = $result->fetch_assoc()) {
            echo '
            <div class="row mb-2 mt-2">
                <div class="d-flex justify-content-start align-items-center col-6">
                    <span class="font-weight-bold">'.$wiersz['id'].' | '.'</span>
                    <span class="p-2" style="border-bottom: 2px solid'.$wiersz['kolor'].'">'.$wiersz['marka']." ".$wiersz['model'].'</span>
                </div>
                <div class="col-6 mt-2 ">
                    <a href="display-reservation.php?id='.$wiersz["id"].'"><div class="mt-1 btn btn-primary">Rezerwacje</div></a>
                    <a href="update-car.php?id='.$wiersz["id"].'"><div class="mt-1 btn btn-primary">Edytuj</div></a>
                    <a href="delete-car-handler.php?id='.$wiersz["id"].'"><div class="mt-1 btn btn-danger">Usuń</div></a>
                </div>
            </div>
            ';
        }
    }
}

function generateDivsForReservationsInDatabase($conn) {
    $sql = "SELECT * FROM rezerwacje";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while($wiersz = $result->fetch_assoc()) {
            echo '
            <div class="row mb-2">
                <div class="col-6">
                    <span class="font-weight-bold">'.$wiersz['id_samochodu'].' | '.'</span>
                    <span>'.$wiersz['data_rozpoczecia']." ".$wiersz['data_zakonczenia'].'</span>
                </div>
                <div class="col-6 justify-content-end">
                    <a href="update-reservation.php?id='.$wiersz["id"].'"><div class="btn btn-primary mt-1">Edytuj</div></a>
                    <a href="delete-reservation-handler.php?id='.$wiersz["id"].'"><div class="btn btn-danger mt-1">Usuń</div></a>
                </div>
            </div>
            ';
        }
    }
}

function getReservationById($conn, $id) {
    $sql = "SELECT * FROM rezerwacje WHERE id='$id'";
    $result = querySelect($conn, $sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $reservationData = $row['reservation_data'];
        return $reservationData;
    } else {
        return null;
    }
}



?>