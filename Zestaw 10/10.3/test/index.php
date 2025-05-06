<?php
require_once 'script.php';
session_start();

if (!isset($_SESSION['cars'])) {
    $_SESSION['cars'] = [];
}

if (isset($_POST["submit_car"])) {
    $car = new Car($_POST['model'], $_POST['price'], $_POST['exchange_rate']);
    $_SESSION['cars'][] = $car;
}
if (isset($_POST['submit_new_car'])) {
    $car = new NewCar($_POST['model'], $_POST['price'], $_POST['exchange_rate'], isset($_POST['alarm']), isset($_POST['radio']), isset($_POST['climatronic']));
    $_SESSION['cars'][] = $car;
}
if (isset($_POST['submit_insurance_car'])) {
    $car = new InsuranceCar(
        $_POST['model'],$_POST['price'],$_POST['exchange_rate'],isset($_POST['alarm']),isset($_POST['radio']),isset($_POST['climatronic']),isset($_POST['first_owner']),$_POST['years']);
        $_SESSION['cars'][] = $car;
}

if (isset($_POST['submit_delete_car'])) {
    $index = $_POST['delete_index'];
    if (isset($_SESSION['cars'][$index])) {
        unset($_SESSION['cars'][$index]);
    }
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Car inventory</h1>
        <p>Total cars: <?php  ?></p>
        <label for="car_inventory_options">Select car type:</label><br>
        <select name="car_inventory_options" id="car_inventory_options">
            <option value="car">Car</option>
            <option value="new_car">New Car</option>
            <option value="insurance_car">Insurance Car</option>
        </select>
        <form action="index.php" method="post" id="car" class="forms">
            <h1>Add Car</h1>
            <label for="model">Model:</label>
            <input type="text" name="model" required>
            <label for="price">Price (EUR):</label>
            <input type="number" name="price" required>
            <label for="exchange_rate">Exchange Rate (PLN):</label>
            <input type="number" name="exchange_rate" step="0.1" min="0" required>
            <button type="submit" name="submit_car">Add Car</button>
        </form>
        <form action="index.php" method="post" id="new_car" class="forms">
            <h1>Add New Car</h1>
            <label for="model">Model:</label>
            <input type="text" name="model" required>
            <label for="price">Price (EUR):</label>
            <input type="number" name="price" required>
            <label for="exchange_rate" step="0.1" min="0">Exchange Rate (PLN):</label>
            <input type="number" name="exchange_rate" required>
            <label for="alarm">Alarm:</label>
            <input type="checkbox" id="alarm" name="alarm" value="alarm">
            <label for="radio">Radio:</label>
            <input type="checkbox" id="radio" name="radio" value="radio">
            <label for="climatronic">Climatronic:</label>
            <input type="checkbox" id="climatronic" name="climatronic" value="climatronic">
            <button type="submit" name="submit_new_car">Add Car</button>
        </form>
        <form action="index.php" method="post" id="insurance_car" class="forms">
            <h1>Add Insurance Car</h1>
            <label for="model">Model:</label>
            <input type="text" name="model" required>
            <label for="price">Price (EUR):</label>
            <input type="number" name="price" required>
            <label for="exchange_rate" step="0.1" min="0">Exchange Rate (PLN):</label>
            <input type="number" name="exchange_rate" required>
            <label for="alarm">Alarm:</label>
            <input type="checkbox" id="alarm" name="alarm" value="alarm">
            <label for="radio">Radio:</label>
            <input type="checkbox" id="radio" name="radio" value="radio">
            <label for="climatronic">Climatronic:</label>
            <input type="checkbox" id="climatronic" name="climatronic" value="climatronic">
            <label for="first_owner">First owner:</label>
            <input type="checkbox" id="first_owner" name="first_owner" value="first_owner">
            <label for="years">Years:</label>
            <input type="number" name="years" required>
            <button type="submit" name="submit_insurance_car">Add Car</button>
        </form>
        <h1>Added Cars:</h1>    
        <table id="cars_table" cellspacing="10">
            <tr>
                <th>Type</th>
                <th>Model</th>
                <th>Price</th>
                <th>Exchange Rate</th>
                <th>Detailed info / Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            foreach ($_SESSION['cars'] as $index => $car) {
                echo "<tr>";
                echo "<td>" . get_class($car) . "</td>";
                echo "<td>" . $car->getModel() . "</td>";
                echo "<td>" . $car->getPrice() . "</td>";
                echo "<td>" . $car->getExchangeRate() . "</td>";
                echo '<td><form action="info.php" method="post"><input type="hidden" name="car_index" value="' . $index . '"><button type="submit" name="submit_info_car">Info</button></form></td>';

                
                if(isset($_POST['submit_info_car'])) { header('Location: info.php'); } 
                
                echo '<td><form action="index.php" method="post"><input type="hidden" name="delete_index" value="' . $index . '"><button type="submit" name="submit_delete_car">Delete</button></form></td>';
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>
