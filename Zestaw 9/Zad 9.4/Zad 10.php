<?php
$s = readline();

if (($s[0] !== "#") || preg_match('/.[^A-Fa-f0-9]/', $s)){
        echo "False";
    } else echo "True";
?>