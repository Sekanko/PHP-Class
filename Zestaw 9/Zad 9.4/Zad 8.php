<?php
$s = readline();

preg_match('/\((.*?)\)|(<.*?>)|({.*?})|\[(.*?)\]/',$s,$match);

for ($i = 1; $i < strlen($match[0])-1; $i++) {
    echo $match[0][$i];
}
?>