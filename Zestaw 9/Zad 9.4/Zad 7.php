<?php
$s = readline();

$result = preg_split('/\s/', $s);

echo implode('', $result);
?>