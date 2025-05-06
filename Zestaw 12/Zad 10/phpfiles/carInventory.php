<?php
include 'CarClasses.php';
include 'globalFunctions.php';
    session_start();
    ob_start();
    if (!isset($_SESSION['operationCar'])){
        $_SESSION['operationCar'] = null;
    }

    if (!isset($_SESSION['operationCarId'])){
        $_SESSION['operationCarId'] = null;
    }


    if (!isset($_SESSION['carList'])) {
        $_SESSION['carList'] = array();
    }

    if (isset($_POST['addCar']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $objectType = $_POST['objectType'];
        $model = $_POST['model'];
        $price = doubleval($_POST['price']);
        $exchangeRate = doubleval($_POST['exchangeRate']);
        $alarm = isset($_POST['alarm']);
        $radio = isset($_POST['radio']);
        $clima = isset($_POST['climatronic']);
        $firstOwner = isset($_POST['firstOwner']);

        switch ($objectType) {
            case 'Car':
                $addedCar = new Car($model, $price, $exchangeRate);
                $_SESSION['carList'][] = $addedCar;
                break;
            case 'NewCar':
                $addedCar = new NewCar($model, $price, $exchangeRate,
                    $alarm, $radio,$clima);
                $_SESSION['carList'][] = $addedCar;
                break;
            case 'InsuranceCar':
                if (!isset($_POST['years'])) {
                    $years = 0;
                } else $years = intval($_POST['years']);
                $addedCar = new InsuranceCar($model, $price, $exchangeRate,
                    $alarm,$radio,$clima,
                    $firstOwner, $years);
                $_SESSION['carList'][] = $addedCar;
                break;
        }
        goToPage('carInventory.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Inventory</title>
    <link rel="stylesheet" href="../styles/globalStyles.css">
    <link rel="stylesheet" href="../styles/carInventoryStyles.css">
</head>
<body>
<div id="container">
    <h1 class="title">Car Inventory</h1>
    <p>Amount of cars: <?php echo sizeof($_SESSION['carList'])?></p>
    <form action="carInventory.php" method="post">
        <label for="objectType">Select car type:</label><br>
        <select name="objectType" id="objectType">
            <option value="Car">Car</option>
            <option value="NewCar">New Car</option>
            <option value="InsuranceCar">Insurance Car</option>
        </select>

        <h2 class="title" id="addCarTitle">Add Car</h2>
        <h2 class="title" id="addNewCarTitle">Add New Car</h2>
        <h2 class="title" id="addInsuranceCarTitle">Add Insurance Car</h2>

        <div id="carContainer" class="divConfig">
            <label for="model">Model:</label>
            <input type="text" id="model" name="model" required pattern=".*\S+.*" title="Pole nie może być puste lub wyłącznie białych znaków">

            <label for="priceEuro">Price (EURO):</label>
            <input type="number" id="priceEuro" name="price" min="0" required step="0.0001" value="0">

            <label for="exchangeRate">Exchange Rate (PLN):</label>
            <input type="number" id="exchangeRate" name="exchangeRate" onloadstart="0" min="0.0001" required step="0.0001" value="0">
        </div>

        <div id="newCarContainer" class="divConfig">
            <label for="alarm">Alarm:</label>
            <input type="checkbox" name="alarm" id="alarm">

            <label for="radio">Radio:</label>
            <input type="checkbox" name="radio" id="radio">

            <label for="climatronic">Climatronic:</label>
            <input type="checkbox" name="climatronic" id="climatronic">
        </div>

        <div id="insuranceCarContainer" class="divConfig">
            <label for="firstOwner">First Owner:</label>
            <input type="checkbox" name="firstOwner" id="firstOwner">
            <label for="years">Years</label>
            <input type="number" id="years" name="years" min="0" value="0">
        </div>
        <input type="submit" name="addCar" value="Add Car" class="classicSubmit">
    </form>
    <?php if (sizeof($_SESSION['carList']) > 0):?>
    <div id="carDisplayContainer">
        <h2 class="title">Car List</h2>
        <form action="carInventory.php" method="post" id="carListForm">
            <div id="searchDiv">
                <label>
                    <p>Search by car's model or key</p>
                    <input type="text" name="searchText" id="searchText" placeholder="Search" pattern=".*\S+.*" title="Pole nie może zawierać wyłącznie białych znaków">
                </label>
                <label>
                    <p>Filter list by type</p>
                    <select name="filter" id="filter">
                        <option value="All">All</option>
                        <option value="Car">Car</option>
                        <option value="NewCar">New Car</option>
                        <option value="InsuranceCar">Insurance Car</option>
                    </select>
                </label>
                <input type="submit" name="searchButton" value="Search" id="searchButton" class="classicSubmit">

            </div>
            <div id="carDisplay">
                <?php
                usort($_SESSION['carList'], function($a, $b) {
                    return strLen(get_class($a)) <=> strLen(get_class($b));
                });
                $carFlag = true;
                $newCarFlag = false;
                $insuranceCarFlag = false;
                $empty = true;

                foreach ($_SESSION['carList'] as $key => $car) {
                    if (!($car instanceof Car)){
                        continue;
                    }

                    if (isset($_POST['searchButton'])){
                        $searchText = isset($_POST['searchText']) ? $_POST['searchText'] : '';
                        $filter = $_POST['filter'];

                        if ($searchText !== '' && !($searchText == $car->getModel() || $searchText == $car->getKey())) {
                            continue;
                        }

                        if ($filter != 'All' && $filter != get_class($car)){
                            continue;
                        }
                    }

                    if (isset($_POST['delete'. $key])){
                        $_SESSION['operationCar'] = $car;
                        $_SESSION['operationCarId'] = $key;
                        goToPage('deletePage.php');
                    }

                    if (isset($_POST['edit'. $key])){
                        $_SESSION['operationCar'] = $car;
                        $_SESSION['operationCarId'] = $key;
                        goToPage('editPage.php');
                    }

                    if (isset($_POST['details'. $key])){
                        $_SESSION['operationCar'] = $car;
                        $_SESSION['operationCarId'] = $key;
                        goToPage('detailsPage.php');
                    }

                    if (isset($_POST['getPrice'. $key])){
                        $_SESSION['operationCar'] = $car;
                        $_SESSION['operationCarId'] = $key;
                        goToPage('price.php');
                    }

                    echo "<fieldset>";
                    echo "<legend> <img src='../pictures/car.png' alt='carPicture'>
                    <input type='submit' class='detailButton' value='Details' name='details" . $key ."'>".
                        "<input type='submit' class='getPriceButton' value='Get price' name='getPrice" . $key ."'>".
                        "<input type='submit' class='editButton' value='Edit' name='edit" . $key ."'>".
                        "<input type='submit' class='deleteButton' value='Delete' name='delete" . $key ."'>" .
                        "</legend>";
                    echo "<div class='carModelView'>Car:<b>" . $car->getModel() . "</b></div>Car's key: <b>" .  $car->getKey(). "</b><br> type: <b>" . get_class($car) . "</b>";
                    echo "</fieldset>";
                    $empty = false;
                }
                ?>
            </div>
            <?php if ($empty):?>
            <h2 class="error">Nie znaleziono takiego samochodu</h2>
            <?php endif;?>
        </form>
    </div>
    <?php endif;?>



</div>
</body>
</html>