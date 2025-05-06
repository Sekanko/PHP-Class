<?php
$s = readline();

$s = preg_replace('/\b0+(\d+)\b/', '$1', $s);

echo $s;
?>