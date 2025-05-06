<?php
$s = readline();

preg_match_all('/<\/.*?>/', $s, $matches);

foreach ($matches[0] as $match) {
    echo $match . ' ';
}
?>