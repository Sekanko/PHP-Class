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
    <title>Price of the car</title>
    <link rel="stylesheet" href="../styles/globalStyles.css">
    <link rel="stylesheet" href="../styles/priceStyles.css">

</head>
<body>
<div id="container">
    <span><?php echo"Car's key: " . $car->getKey() . ", Car model: " . $car->getModel();?></span>
    <p>Price of this car</p>
    <h1>
        <?php
            $price = number_format($car->value(), 2,".", " ");
            echo $price;
        ?>
        PLN
    </h1>
    <form action="price.php" method="post">
        <input type="submit" name="back" value="Back" class="classicSubmit">
    </form>
</div>
</body>
</html>
