<?php

function cleanArray($array)
{
    $array = array_map('trim', $array);
    $array = array_values(array_filter($array, function($value) {return strlen(($value)) > 0;}));
    return $array;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My</title>
    <link rel="stylesheet" href="Styles8.css">
</head>
<body>
<div id="container">
    <h1>Zarządzanie Opiniami</h1>
    <form action="Zad%208.php" method="post" id="newOpinionForm">
        <textarea name="newOpinion" id="newOpinion" placeholder="Wpisz swoją opinię" ></textarea>
        <input type="submit" name="addOpinion" id="addOpinion" value="Dodaj opinię">
    </form>
    <div id="opinionsContainer">
        <h2>Opinie:</h2>
        <form action="Zad%208.php" method="post" id="savedOpinionsFrom">
            <div id="scriptDiv">
                <?php
                    $file = fopen("opinions.txt", "r+");
                    $opinions = [];
                    $flag = false;

                    if (isset($_POST['resetButton'])){
                        file_put_contents("opinions.txt", "");
                        fclose($file);
                        header('Location: Zad%208.php');
                        exit();
                    }

                    if (filesize("opinions.txt") != 0) {
                        $opinions = explode("@;", fread($file, filesize("opinions.txt")));
                        $opinions = cleanArray($opinions);

                        for ($i = 0; $i < count($opinions); $i++) {

                            if (isset($_POST['deleteButton' . $i])){
                                $opinions[$i] = '';
                                $flag = true;
                                continue;
                            }

                            if (isset($_POST['saveButton' . $i])){
                                $opinions[$i] = $_POST['changedOpinion' . $i];
                            }

                            echo "<div class='optionDiv'>";


                            if (isset($_POST['editButton' . $i])){
                                echo '<textarea class="opinionText" name = "changedOpinion' . $i . '">'  . trim($opinions[$i]) . '</textarea>';
                                echo '<input type="submit" name="saveButton' . $i . '" id="saveButton' . $i . '" class="saveButton" value="Zapisz">';
                                echo '<input type="submit" name="cancelButton' . $i . '" id="cancelButton' . $i . '" class="cancelButton" value="Cofnij">';

                            } else{
                                echo '<textarea class="opinionText" readonly>'. trim($opinions[$i]) . '</textarea>';
                                echo '<input type="submit" name="editButton' . $i . '" id="editButton' . $i . '" class="editButton" value="Edytuj">';
                                echo '<input type="submit" name="deleteButton' . $i . '" id="deleteButton' . $i . '"  class="deleteButton" value="Usuń">';
                            }

                            echo "</div>";
                        }
                    }

                if (isset($_POST['addOpinion'])){
                    $newOpinion = $_POST['newOpinion'];
                    $opinions[] = $newOpinion;
                    $flag = true;
                }

                $opinions = cleanArray($opinions);
                $toSave = implode("@;\n", $opinions);
                file_put_contents("opinions.txt", $toSave);
                fclose($file);

                if ($flag){
                    header('Location: Zad%208.php');
                    exit();
                }

                ?>
            </div>
        <input type="submit" name="resetButton" id="resetButton" value="Resetuj wszystko">
        </form>
    </div>
</div>
</body>
</html>