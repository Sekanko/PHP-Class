<?php
    session_start();
    $_cookieKey = $_SESSION['cookieName'];
    if (isset($_POST['cancel'])){
        header("Location: Zad%205.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edytor ciasteczek</title>
    <link rel="stylesheet" href="globalStyles.css">
    <link rel="stylesheet" href="editCookieStyles.css">
</head>
<body>
<div id="container">
    <h1>Edytujesz ciasteczko:<br> <?php echo urldecode($_cookieKey)?></h1>
    <form action="editCookie.php" method="post" id="firstForm">
        <input type="text" name="newName" placeholder="Wpisz nową nazwę ciasteczka" required value="<?php echo urldecode($_cookieKey);?>">
        <input type="text" name="newValue" placeholder="Wpisz nową wartość ciasteczka" required value="<?php echo urldecode($_COOKIE[$_cookieKey])?>">
        <input type="datetime-local" name="newTime" min="<?php echo date('Y-m-d\TH:i');?>">
        <p class="infoMessage">(Data wygaśnięcia jest opcjonlana)</p>
        <input type="submit" name="save" value="Zapisz" class="classicSubmit">
    </form>
    <form action="editCookie.php" method="post" id="secondForm">
        <input type="submit" name="cancel" value="Anuluj">
    </form>
    <?php
    if (isset($_POST['save'])){
        $newName = urlencode($_POST['newName']);
        $newValue = urlencode($_POST['newValue']);
        $editFlag = false;

        if (isset($_POST['newTime'])){
            $newTime = $_POST['newTime'];
            setcookie($newName, $newValue, strtotime($newTime));
        } else setcookie($newName, $newValue, time() + 3600);

        if ($newName != $_cookieKey){

            foreach ($_COOKIE as $key => $value){
                if ($key == $newName){
                    $editFlag = true;
                    break;
                }
            }

            if ($editFlag){
                echo "<p class='errorMessage'>Nazwa jest zajęta przez inne ciastko!<br>
                    Podaj inną nazwę lub cofnij się i wybierz odpowiednie ciasteczko<p>";
            } else setcookie($_cookieKey, '', time() - 3600);

        }

        if (!$editFlag){
            header('Location: Zad%205.php');
            exit();
        }
    }
    ?>
</div>
</body>
</html>
