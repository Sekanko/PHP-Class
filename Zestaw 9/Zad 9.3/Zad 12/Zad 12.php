<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Strop</title>
    <link rel="stylesheet" href="Styles12.css">
</head>
<body>
<div id="container">
    <h1>Zaawansowana analiza ciągów znaków</h1>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <label for="text">Wpisz tekst:</label>
        <input type="text" id="text" name="text" placeholder="Twój tekst">

        <label for="operation">Wybierz operację:</label>
        <select name="operation" id="operation">
            <option value="extractPlus">Ekstrakcja unikalnych słów i ich częstotliwość występowania</option>
            <option value="sort">Sortowanie alfabetyczne słów w ciągu z opcją rosnąco i malejąco</option>
        </select>

        <div id="sortContainer">
            <label for="sortType">Jak chcesz posortować?</label>
            <select name="sortType" id="sortType">
                <option value="asc">Rosnąco</option>
                <option value="desc">Malejąco</option>
            </select>
        </div>
        <input type="submit" id="submit" value="Wykonaj">
    </form>
    <div id="result">
        <strong>Wynik:</strong> <br>
        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $text = $_POST["text"];
            $operation = $_POST["operation"];
            $sortType = $_POST["sortType"];

            if ($text === ''){
                echo "Twój tkest jest pusty!";
            } else {
                switch ($operation){
                    case "extractPlus":
                        echo "<table><tr><th>Słowa</th><th>Częstotliwość</th></tr>";

                        $explodedText = explode(" ", $text);
                        $explodedText = array_unique($explodedText);

                        foreach ($explodedText as $value) {
                            echo "<tr><td>" . $value . "</td><td> " . substr_count($text, $value) . "</td></tr>";
                        }
                    echo "</table>";
                        break;
                    case "sort":
                        $toSort = explode(" ", $text);
                        if ($sortType == "asc"){
                            sort($toSort);
                        } else{
                            rsort($toSort);
                        }
                        $toSort = implode(" ", $toSort);
                        echo $toSort;

                }
            }
        }
        ?>
    </div>
</div>

</body>
</html>