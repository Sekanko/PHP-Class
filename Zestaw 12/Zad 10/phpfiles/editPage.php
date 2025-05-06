<?php
include 'CarClasses.php';
include 'globalFunctions.php';

    session_start();
    $car = $_SESSION['operationCar'];
    $objectType = get_class($car);

    if (isset($_POST['cancel'])){
        goToPage('carInventory.php');
    }

    if (isset($_POST['save'])){
        $model = $_POST['model'];
        $price = doubleval($_POST['price']);
        $exchangeRate = doubleval($_POST['exchangeRate']);
        if ($exchangeRate == 0){
            $exchangeRate = 0.0001;
        }
        $alarm = isset($_POST['alarm']);
        $radio = isset($_POST['radio']);
        $clima = isset($_POST['climatronic']);
        $firstOwner = isset($_POST['firstOwner']);

        if ($car instanceof Car){
            if ($model !== "")
                $car->setModel($model);

            $car->setPrice($price);
            $car->setExchangeRate($exchangeRate);
        }

        if ($car instanceof NewCar){
            $car->setAlarm($alarm);
            $car->setRadio($radio);
            $car->setClimatronic($clima);
        }

        if ($car instanceof InsuranceCar){
            $car->setFirstOwner($firstOwner);
            if ($_POST['years'] !== null) {
                $car->setYears($_POST['years']);
            }
        }
        goToPage('carInventory.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit the car</title>
    <link rel="stylesheet" href="../styles/globalStyles.css">
    <link rel="stylesheet" href="../styles/editPageStyles.css">
</head>
<body>

<div id="container">
    <h2>Editing Car:</h2>
    <h3 id="infoCar">
            <?php echo "Car's key: " . $car->getKey() . "<br>Car's Model: " . $car->getModel()?>
    </h3>
    <span id="infoSpan">If you left model blank, it won't change and if you left any number blank, it will change to ZERO!</span>
    <form action="editPage.php" method="post">
        <label for="model">Model:</label>
        <input type="text" id="model" name="model" value="<?php echo $car->getModel()?>" pattern=".*\S+.*" title="Pole nie może być puste lub zawierać wyłącznie białych znaków">

        <label for="priceEuro">Price (EURO):</label>
        <input type="number" id="priceEuro" name="price" min="0" step="0.0001"" value="<?php echo $car->getPrice()?>">

        <label for="exchangeRate">Exchange Rate (PLN):</label>
        <input type="number" id="exchangeRate" name="exchangeRate" min="0.0001" step="0.0001" value="<?php echo $car->getExchangeRate()?>">

        <?php if ($objectType === "NewCar" || $objectType === "InsuranceCar"): ?>
            <label for="alarm">Alarm:</label>
            <input type="checkbox" name="alarm" id="alarm" <?php if ($car->getAlarm()):?> checked <?php endif;?>>

            <label for="radio">Radio:</label>
            <input type="checkbox" name="radio" id="radio" <?php if ($car->getRadio()):?> checked <?php endif;?>>

            <label for="climatronic">Climatronic:</label>
            <input type="checkbox" name="climatronic" id="climatronic" <?php if ($car->getClimatronic()):?> checked <?php endif;?>>

            <?php if ($objectType === "InsuranceCar"): ?>
                <label for="firstOwner">First Owner:</label>
                <input type="checkbox" name="firstOwner" id="firstOwner" <?php if ($car->getFirstOwner()):?> checked <?php endif;?>>

                <label for="years">Years</label>
                <input type="number" id="years" name="years" min="0" value="<?php echo $car->getYears()?>">
            <?php endif;?>
        <?php endif;?>
        <div id="inputs">
            <input type="submit" name="save" value="Save" class="classicSubmit">
            <input type="submit" name="cancel" value="Cancel" class="classicSubmit" formnovalidate>
        </div>
    </form>


</div>
</body>
</html>