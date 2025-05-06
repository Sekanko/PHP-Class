<?php
    session_start();
$sessionCookieName = session_name();
if (!isset($_COOKIE[$sessionCookieName])) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menadżer ciasteczek</title>
    <link rel="stylesheet" href="globalStyles.css">
    <link rel="stylesheet" href="zad5Styles.css">
</head>
<body>
<div id="container">
    <h1>Menadżer ciasteczek</h1>
    <p class="infoMessage">(od góry ostatnio edytowane)</p>
    <nav>
        <a href="#header">Znajdź ciasteczko</a>
        <a href="#showAllCookies">Ciasteczka</a>
        <a href="#addForm">Dodaj ciasteczko</a>
    </nav>
    <div id="header">
        <div id="findLabelContainer">
            <h2 id="findH2">Wyszukaj ciasteczko</h2>
            <p class="infoMessage">Aby wyświtlić całą listę ciasteczek kliknij szukaj, bez podawania wartości</p>
        </div>
        <form action="Zad%205.php" method="post" id="headerForm">
            <input type="text" name="search" placeholder="Szukana nazwa/wartość">
            <input type="submit" name="searchButton" value="Szukaj" class="classicSubmit">
        </form>
    </div>
    <?php
    if (isset($_POST['add'])){
        $name = urlencode($_POST['cookieName']);
        $cookieValue = urlencode($_POST['cookieValue']);
        $time = strtotime($_POST['cookieTime']);
        $addFlag = false;

        foreach ($_COOKIE as $key => $value) {
            if ($name == $key){
                $addFlag = true;
                break;
            }
        }

        if ($addFlag){
            echo "<strong><p class='errorMessage'>Ciasteczko z taką nazwą/kluczem już istnieje! Podaj inną nazwę</strong><p>";

        } else{
            setcookie($name,$cookieValue,$time);
            header("Location: Zad%205.php");
            exit();
        }
    }
    ?>
    <div id="showAllCookies">
        <form action="Zad%205.php" method="post">
            <?php
            if (count($_COOKIE) > 0) {
                foreach ($_COOKIE as $key => $value) {

                    if (isset($_POST['searchButton'])){
                        $search = urlencode($_POST['search']);

                        if ($search == '') {
                            header("Location: Zad%205.php");
                            exit();
                        }

                        if ($search != $key && $search != $value) {
                            continue;
                        }
                    }

                    if (isset($_POST['delete' . $key])){
                        setcookie($key,'',time()-3600);
                        echo "<p class='errorMessage'>Usunięto ciasteczko o kluczu: " . urldecode($key) . "</p>";
                        unset($_POST['delete' . $key]);
                        continue;
                    }

                    echo "<fieldset>";
                    echo "<legend>Ciasteczko</legend>";
                    if (isset($_POST["edit" . $key])){
                        $_SESSION['cookieName'] = $key;
                        header("Location: editCookie.php");
                        exit();
                    } else{
                        echo "<span><label>Nazwa ciasteczka:<strong>". urldecode($key) . "</strong> </label>" . "<label>Wartość ciasteczka: <strong>". urldecode($value) . "</strong></label></span>" ;
                        echo "<span><input type='submit' class='editButton' name='edit" . $key . "' value='Edytuj ciasteczko'><input type='submit' class='deleteButton' name='delete" . $key . "' value='Usuń ciasteczko'></span>";
                    }
                    echo "</fieldset>";
                }
                unset($_POST['searchButton']);
            } else echo "Brak ciasteczek!";


            ?>
        </form>
        <form action="Zad%205.php" method="post" id="addForm">
            <h2>Dodawanie ciasteczka</h2>

            <input type="text" name="cookieName" placeholder="Nazwa ciasteczka" required>
            <input type="text" name="cookieValue" placeholder="Wartość ciasteczka" required>
            <input type="datetime-local" id="cookieTime" name="cookieTime" min="<?php echo date('Y-m-d\TH:i'); ?>">
            <p class="infoMessage">(Data wygaśnięcia jest opcjonlana)</p>
            <input type="submit" name="add" value="Dodaj ciasteczko" class="classicSubmit">

        </form>
    </div>

</div>
</body>
</html>