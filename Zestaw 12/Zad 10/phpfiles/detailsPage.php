<?php
include 'CarClasses.php';
include 'globalFunctions.php';

    session_start();
    $car = $_SESSION['operationCar'];
    if (!($car instanceof Car)){
        throw new Exception("Car must be an instance of Car");
    }

    if (isset($_POST['back'])){
        goToPage('carInventory.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../styles/globalStyles.css">
    <link rel="stylesheet" href="../styles/detailsPage.css">

</head>
<body>
<div id="container">
    <div id="info">
        <span>Key: <b><?php echo $car->getKey();?></b></span><br>
        <?php
            echo $car;
        ?>
    </div>
    <form action="detailsPage.php" method="post">
        <input type="submit" name="back" value="Back" class="classicSubmit">
    </form>
</div>
</body>
</html>