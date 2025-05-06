<?php
$s = readline();

if (preg_match("/\B[g]\B/", $s) || !preg_match("/[g]/", $s)) {
    echo "True";
} else echo "False";
?>

