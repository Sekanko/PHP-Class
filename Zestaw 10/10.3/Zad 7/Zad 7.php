<?php
$file = 'counter.txt';

if (isset($_POST["resetButton"])) {
    file_put_contents($file, -1);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if (file_exists($file)) {
    $counter = intval(file_get_contents($file));
    $counter++;
} else $counter = 0;

file_put_contents($file, $counter);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="Styles7.css">
</head>
<body>
<div id="container">
    <h1>Licznik odwiedzin witryny</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
        <span id="counter">Odwiedzin: <?php echo $counter;?></span> <br>
        <input type="submit" name="resetButton" value="Resetuj licznik">
    </form>
</div>
</body>
</html>