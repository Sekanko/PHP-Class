<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Strop</title>
    <link rel="stylesheet" href="Styles11.css">
</head>
<body>
<div id="container">
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <label for="text">Wpisz tekst:</label>
        <input type="text" id="text" name="text" placeholder="Twój tekst">
        <label for="operation">Wybierz operację:</label>
        <select name="operation" id="operation">
            <option value="revers">Odwróć ciąg znaków</option>
            <option value="upper">Zamiana wszystkich liter na wielkie</option>
            <option value="lower">Zamiana wszystkich liter na małe</option>
            <option value="length">Liczenie liczby znaków</option>
            <option value="ltrim">Usuwanie białych znaków z początku</option>
            <option value="rtrim">Usuwanie białych znaków z końca</option>
            <option value="trim">Usuwanie białych znaków z początku i końca ciągu</option>
        </select> <br>
        <input type="submit" id="submit" value="Wykonaj">
    </form>
    <div id="result">
        <strong>Wynik: </strong><br>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $text = $_POST["text"];
            $operation = $_POST["operation"];
            if ($text === ''){
                echo "Nie podano żadnego ciągu!";
            }
            switch ($operation) {
                case "revers":
                    echo '<pre>'. strrev($text) . '</pre>';
                    break;
                case "upper":
                    echo '<pre>'. strtoupper($text) . '</pre>';
                    break;
                case "lower":
                    echo '<pre>'. strtolower($text) . '</pre>';
                    break;
                case "length":
                    echo '<pre>'. strlen($text) . '</pre>';
                    break;
                case "ltrim":
                    echo '<pre>'. ltrim($text) . '</pre>';
                    break;
                case "rtrim":
                    echo '<pre>'. rtrim($text) . '</pre>';
                    break;
                case "trim":
                    echo '<pre>'. trim($text) . '</pre>';
                    break;
            }
        }
        ?>
    </div>
</div>

</body>
</html>