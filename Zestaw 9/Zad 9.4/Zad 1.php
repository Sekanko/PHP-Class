<?php
$s = readline();

if (preg_match("/^[a-zA-Z0-9]+$/", $s)){
    echo "True";
} else echo "False";
?>