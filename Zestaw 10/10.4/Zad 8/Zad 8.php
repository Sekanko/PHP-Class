<?php
    function isDateGood($month ,$year)
    {
        if (strlen($month)!=2 || strlen($year)<4)
            return false;
        return checkdate(intval($month),1,intval($year));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kalnedarz</title>
    <link rel="stylesheet" href="Styles8.css">
</head>
<body>
<div id="container">
    <h1>Generuj kalendarz</h1>
    <form action="Zad%208.php" method="get" id="calendarGenerator">
        <input type="text" name="month" placeholder="Miesiąc (mm)" id="month" required>
        <input type="text" name="year" placeholder="Rok (yyyy)" id="year" required>
        <input type="submit" class="classicSubmit" name="generateCalendarButton" value="Generuj kalendarz">
    </form>
    <?php
    $footerFlag = false;
    $date = date_create();
        if (isset($_GET['month']) && isset($_GET['year']) && isDateGood($_GET['month'],$_GET['year'])) {
            $url = $_SERVER['REQUEST_URI'];
            $month = $_GET['month'];
            $year = $_GET['year'];
            $date = new DateTime("$year-$month-01");

            $polishMonths = array(
                1 => 'Styczeń',
                2 => 'Luty',
                3 => 'Marzec',
                4 => 'Kwiecień',
                5 => 'Maj',
                6 => 'Czerwiec',
                7 => 'Lipiec',
                8 => 'Sierpień',
                9 => 'Wrzesień',
                10 => 'Październik',
                11 => 'Listopad',
                12 => 'Grudzień'
            );
            $polishWeek = array(
                0 => 'Niedziela',
                1 => 'Poniedziałek',
                2 => 'Wtorek',
                3 => 'Środa',
                4 => 'Czwartek',
                5 => 'Piątek',
                6 => 'Sobota'
            );
            $day = 1;
            $workingDate = new DateTime($year . '-' . $month . '-01');

            echo "<h2>" . $polishMonths[intval($date->format('m'))] . " " . $date->format('Y') . "</h2>";
            echo "<div id='calendar'>";

            for ($i = 0; $i < 42; $i++) {
                if ($i < 7) {
                    echo "<div class='plate dayOfWeek'>" . $polishWeek[$i] . "</div>";
                } else {
                    echo "<div class='plate'>";
                    if ($workingDate->format('w') == $i % 7 &&
                        $day <= cal_days_in_month(CAL_GREGORIAN, $workingDate->format('m'), $workingDate->format('Y'))) {
                        echo $day++;
                        $workingDate->modify('+1 day');
                    }
                    echo "</div>";
                }
            }
            echo "</div>";

            $footerFlag = true;
        } else if (isset($_GET['month']) && isset($_GET['year']) && !isDateGood($_GET['month'],$_GET['year'])){
            echo "<p class='errorMessage'>Podano nieprawidłową datę</p>";
        }
    ?>
    <nav id="footer">
        <?php
        if ($footerFlag) {
            $date->modify('-1 month');
            if ($month == '01' && $year == '0001'){
                echo "<span class='infoMessage'>Osiągnięto dolną granicę dat</span>";
            } else{
                $url = preg_replace('/month=../','month=' . $date->format('m'), $url);
                $url = preg_replace('/year=..../','year=' . $date->format('Y'), $url);
                echo "<a href='" . $url . "'>Poprzedni miesiąc</a>";
            }

            $date->modify('+2 month');
            if ($month == '12' && $year == '9999'){
                echo "<span class='infoMessage'>Osiągnięto górną granicę dat</span>";
            } else{
                $url = preg_replace('/month=../','month=' . $date->format('m'), $url);
                $url = preg_replace('/year=..../','year=' . $date->format('Y'), $url);
                echo "<a href='" . $url . "'>Nastęny miesiać</a>";
            }
        }
        ?>
    </nav>
</div>
</body>
</html>