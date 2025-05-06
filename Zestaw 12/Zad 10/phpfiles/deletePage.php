<?php
include 'CarClasses.php';
include 'globalFunctions.php';
    session_start();
    $car = $_SESSION['operationCar'];
    $key = $_SESSION['operationCarId'];


    if (isset($_POST['cancel'])){
        goToPage('carInventory.php');
    }

    if (isset($_POST['deleteConfirm'])){
        unset($_SESSION['carList'][$key]);
        goToPage('carInventory.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete the car</title>
    <link rel="stylesheet" href="../styles/globalStyles.css">
    <link rel="stylesheet" href="../styles/deletePageStyles.css">
</head>
<body>
<div id="container">
    <form action="deletePage.php" method="post">
        <h2>Are you sure that you want to delete car below?</h2>
            <h1>
                <?php
                if ($car instanceof Car) {
                    echo "<b><i>Car: " . $car->getModel() . "</i></b><br>";
                    echo "<b><i>Car's key: " . $car->getKey() . "</i></b>";
                }
                ?>
            </h1>
        <br>
        <div id="inputs">
            <input type="submit" name="deleteConfirm" value="Confirm delete" class="deleteButton">
            <input type="submit" name="cancel" value="Cancel" class="classicSubmit">
        </div>
    </form>
</div>
</body>
</html>