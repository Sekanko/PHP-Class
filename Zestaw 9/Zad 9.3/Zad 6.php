<?php
$t = readline();
fscanf(STDIN, "%s %s", $p1, $p2);
fscanf(STDIN, "%s", $k);

$firstWordEndPos = strpos($t, $p1) + strlen($p1);
$secondWordEndPos = strpos($t, $p2)+ strlen($p2);

$t = substr_replace($t,$k . ' ', $firstWordEndPos+1, 0);

echo $t;

?>