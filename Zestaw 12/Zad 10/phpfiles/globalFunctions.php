<?php
function goToPage($dir)
{
    if ($dir === 'carInventory.php'){
        $_SESSION['operationCar'] = null;
        $_SESSION['operationCarId'] = null;
    }

    header('Location: ' . $dir);
    exit();
}