<?php
function generateTimezoneOptions() {
    $timezones = DateTimeZone::listIdentifiers();
    $options = '';

    foreach ($timezones as $timezone) {
        $options .= '<option value="' . htmlspecialchars($timezone) . '">' . htmlspecialchars($timezone) . '</option>';
    }

    return $options;
}

function isDateGood($date)
{
    if (substr_count($date,'-') != 2)
        return false;

    $dateParameters = explode('-', $date);
    return checkdate((int) $dateParameters[1], (int) $dateParameters[0], (int) $dateParameters[2]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daty</title>
    <link rel="stylesheet" href="Styles7.css">
</head>
<body>
<div id="container">
    <h1>Oblicz wiek i dni robocze</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <div class="fillField">
            <h2>Oblicz wiek i czas lokalny</h2>
            <input type="text" class="dateInput" name="birthDate" placeholder="Data urodzenia (dd-mm-YYYY)">
            <select name="timeZone" id="timeZoneForm">
                <?php echo generateTimezoneOptions();?>
            </select>
            <input type="submit" value="Oblicz wiek i czas" name="firstFormSubmit" class="submitButton">
        </div>
        <div class="fillField">
            <h2>Oblicz dni robocze</h2>
            <input type="text" class="dateInput" name="firstDate" placeholder="Data początkowa (dd-mm-YYYY)">
            <input type="text" class="dateInput" name="secondDate" placeholder="Data końcowa (dd-mm-YYYY)">
            <input type="submit" value="Oblicz dni robocze" name="secondFormSubmit" class="submitButton">
        </div>
    </form>

    <div id="result">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['firstFormSubmit']) && isDateGood($_POST['birthDate'])) {
                $selectedTimezone  = $_POST['timeZone'];
                $birthDate = date_create($_POST["birthDate"]);
                $now = new DateTime('now', new DateTimeZone($selectedTimezone));

                echo "<span> Wiek: " . date_diff($now, $birthDate)->format("%y") . " lat.</span><br>";
                echo "<span>Czas lokalny: " . $now->format("H:i:s") . "</span><br>";

            } else if (isset($_POST['firstFormSubmit'])) {
                echo "<span>Podano nieprawidłową datę!</span><br>";
            }


            if (isset($_POST['secondFormSubmit']) && isDateGood($_POST['firstDate']) && isDateGood($_POST['secondDate'])) {
                $firstDate = date_create($_POST["firstDate"]);
                $secondDate = date_create($_POST["secondDate"]);
                $workingDays = 0;
                while ($firstDate <= $secondDate) {
                    if ($firstDate->format('w') != 0 && $firstDate->format('w') != 6){
                        $workingDays++;
                    }
                    $firstDate->modify('+1 day');
                }
                echo "<span> Pomiędzy datami jest " . $workingDays . " dni roboczych.</span><br>";
            }else if (isset($_POST['secondFormSubmit'])) {
                echo "<span>Podano nieprawidłową daty/ę!</span><br>";
            }
        }
        ?>
    </div>
</div>
</body>
</html>