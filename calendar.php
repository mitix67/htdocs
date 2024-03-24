<?php
require_once 'functions.php';
class Calendar
{

    private $active_year, $active_month, $active_day, $price_day, $price_weekend, $price_weekendowa, $price_tyg, $price_miesiac;
    private $events = [];

    public function __construct($date = null, $price_day = 0, $price_weekend = 0, $price_weekendowa = 0, $price_tyg = 0, $price_miesiac = 0)
    {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
        $this->price_day = $price_day ? $price_day : 0; // Default value for price_day
        $this->price_weekend = $price_weekend ? $price_weekend : 0; // Default value for price_weekend
        $this->price_weekendowa = $price_weekendowa ? $price_weekendowa : 0; // Default value for price_weekendowa
        $this->price_tyg = $price_tyg ? $price_tyg : 0; // Default value for price_tyg
        $this->price_miesiac = $price_miesiac ? $price_miesiac : 0; // Default value for price_miesiac
    }

    public function add_event($txt, $date, $days = 1, $color = '')
    {
        $color = $color ? ' ' . $color : $color;
        $this->events[] = [$txt, $date, $days, $color];
    }

    public function clear_events_by_index($index)
    {
        if (isset ($this->events[$index])) {
            unset($this->events[$index]);
        }
    }

    public function __toString()
    {
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Mon', 1 => 'Tue', 2 => 'Wed', 3 => 'Thu', 4 => 'Fri', 5 => 'Sat', 6 => 'Sun'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        $html = '<div class="calendar">';
        $html .= '<div class="header">';
        $html .= '<div class="price" id="price" style="display: none">' . $this->price_day . ' ' . $this->price_weekend . ' '. $this->price_weekendowa . ' ' . $this->price_tyg . ' ' . $this->price_miesiac . '</div>';

        $html .= '<div class="month-year" id="month-year">';

        $html .= date('F Y', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));

        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="days">';
        $days = [0 => 'Pon', 1 => 'Wt', 2 => 'Śr', 3 => 'Czw', 4 => 'Pt', 5 => 'Sob', 6 => 'Ndz'];
        foreach ($days as $day) {
            $html .= '
                <div class="day_name">
                    ' . $day . '
                </div>
            ';
        }
        
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    ' . ($num_days_last_month - $i + 1) . '
                </div>
            ';
        }
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
            if ($i == $this->active_day) {
                $selected = ' selected';
            }
            $html .= '<div onclick="getDateFromButton(this)" class="day_num' . $selected . '">';
            $html .= '<span>' . $i . '</span>';
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2] - 1); $d++) {
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $html .= '<div class="event" style="background-color:' . $event[3] . '; font-size: 0.5vw;">';
                        $html .= $event[0];
                        $html .= '</div>';
                    }
                }
            }
            $html .= '</div>';
        }
        for ($i = 1; $i <= (42 - $num_days - max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore">
                    ' . $i . '
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

}


$calendar = new Calendar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "formattedDate" field is set in the POST request
    if (isset ($_POST["formattedDate"])) {
        // Get the value from the "formattedDate" field
        $date = $_POST["formattedDate"];
        $calendar = new Calendar($date);
        $combined = "";
        $color = "";
        if (isset ($_POST["id"])) {
            $id = $_POST["id"];
            $conn = connectToDatabase();
            if ($id == 5) {
                $reservations = querySelect($conn, "SELECT * FROM rezerwacje");
            } else {
                $reservations = querySelect($conn, "SELECT * FROM rezerwacje WHERE id_samochodu = $id");

                $price_tyg = querySelect($conn, "SELECT dobatyk FROM cennik WHERE id_samochodu = $id")->fetch_assoc()['dobatyk'];
                $price_weekend = querySelect($conn, "SELECT dobawek FROM cennik WHERE id_samochodu = $id")->fetch_assoc()['dobawek'];
                $price_weekondowa = querySelect($conn, "SELECT weekend FROM cennik WHERE id_samochodu = $id")->fetch_assoc()['weekend'];
                $price_tydzien = querySelect($conn, "SELECT tydzien FROM cennik WHERE id_samochodu = $id")->fetch_assoc()['tydzien'];
                $price_miesiac = querySelect($conn, "SELECT miesiac FROM cennik WHERE id_samochodu = $id")->fetch_assoc()['miesiac'];

                $color = getDetailsById($conn, $id, 'kolor');
                $calendar = new Calendar($date, $price_tyg, $price_weekend, $price_weekondowa, $price_tydzien, $price_miesiac);
            }
            while ($row = $reservations->fetch_assoc()) {
                $startDate = new DateTime($row['data_rozpoczecia']);
                $endDate = new DateTime($row['data_zakonczenia']);
                $diff = $endDate->diff($startDate)->days;

                if ($id == 5) {
                    $brand = getDetailsById($conn, $row['id_samochodu'], 'marka');
                    $model = getDetailsById($conn, $row['id_samochodu'], 'model');
                    $combined = $brand . " " . $model;
                }

                $color = getDetailsById($conn, $row['id_samochodu'], 'kolor');


                $calendar->add_event($combined, $row['data_rozpoczecia'], $diff, $color);
            }
            echo $calendar;
        } else {
            echo $calendar;
        }
    } else {
        echo $calendar;
    }
}
?>