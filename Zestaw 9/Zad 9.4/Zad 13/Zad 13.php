<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="Styles13.css">

</head>
<body>

<div id="container">
    <h1>Analyser and Transformer of Tex with Regex in PHP</h1>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <label for="text">Enter text:</label>
        <input type="text" id="text" name="text" required>

        <label for="pattern">Enter Regex Pattern:</label>
        <input type="text" id="pattern" name="pattern" required>

        <label for="operation">Choose operation:</label>
        <select name="operation" id="operation">
            <option value="match">Match</option>
            <option value="matchPos">Find match with positions</option>
            <option value="replace">Replace</option>
            <option value="validate">Validate</option>
        </select>

        <div id="replacementContainer">
            <label for='replacement'>Enter Replacement text:</label>
            <input type="text" name='replacement' id='replacement'>
        </div>

        <input type="submit" value="Execute">
    </form>
    <div id="result">
        <span>Result:</span><br>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $text = $_POST["text"];
                $pattern = $_POST["pattern"];
                $operation = $_POST["operation"];
                $replacement = $_POST["replacement"];

                switch ($operation) {
                    case "match":
                        if (@preg_match_all($pattern, $text, $matches)){
                            echo "Found: " . implode(", ", $matches[0]);
                        }else echo "Could not match regular expression. Check your input.";
                        break;
                    case "matchPos":
                        if (@preg_match_all($pattern, $text, $matches, PREG_OFFSET_CAPTURE)){
                            foreach ($matches[0] as $match) {
                                echo 'Found "'  . $match[0] . '" at position: ' . $match[1] . '<br>';
                            }
                        }
                        else echo "Could not match regular expression. Check your input.";
                        break;
                    case "replace":
                        if (@preg_match($pattern, $text)) {
                            $text = preg_replace($pattern, $replacement, $text);
                            echo 'Text after replacement "' . $text . '"<br>';
                        } else echo "Could not match regular expression. Check your input.";
                        break;
                    case "validate":
                        if (@preg_match($pattern, $text)) {
                            echo 'Text matches pattern';
                        } else echo "Text does not match pattern.";
                        break;
                    default:
                        echo "ERROR";
                }
            }
        ?>
    </div>

    <footer>
        Jako, że instukcje były niejednoznaczne, a konkretnie:
        <strong>"Znajdowanie wszystkich wystąpień wzorca (Match).
            Znajdowanie i wyświetlanie pozycji wystąpień wzorca (Match Positions)."</strong>
        Po czym: <strong>"W przypadku operacji matchowania, wyświetl wszystkie znalezione wystąpienia oraz ich pozycje."</strong>,
        co powodowało by sensownosc tylko jednej z tych opcji, postanowiłem zrobić, żeby match wyświetlało po prostu każdy znaleziony wzorzec"


    </footer>
</div>

</body>
</html>