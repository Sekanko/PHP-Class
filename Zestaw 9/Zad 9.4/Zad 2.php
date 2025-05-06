<?php
$s = readline();

if (preg_match("/^[a-z_]+$/", $s)){
    echo "True";
} else echo "False";
?>