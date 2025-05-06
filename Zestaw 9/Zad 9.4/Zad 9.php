<?php
$s = readline();
$n =readline();
$arr = '';
preg_match_all('/[aeiouAEIOU]/',$s,$matches);

if (!empty($matches[0])) {
    $len = count($matches[0])-1;
    for ($i=$len;$i>$len-$n;$i--){
        $arr .= $matches[0][$i];
    }
}

echo strrev($arr);
?>