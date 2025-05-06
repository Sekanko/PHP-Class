<?php
$var = readline();
if (strpos($var, '.') === false) {
    $var = intval($var);
} else $var = doubleval($var);

echo $var;

?>