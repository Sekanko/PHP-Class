<?php
$s = readline();

$specialChars = str_split('\/:*?"<>|+-' . "'");

$s = str_replace($specialChars, ' ', $s);
$s = ltrim($s);

$result = explode(' ', $s);
$result = array_filter($result, function($value) {
    return trim($value) !== '';
});

echo implode(' ', $result);

?>