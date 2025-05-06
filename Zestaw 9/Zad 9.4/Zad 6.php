<?php
$s = readline();

preg_match_all('/[.,]\d+/', $s, $matches);

echo count($matches[0]);

?>