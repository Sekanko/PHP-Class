
<?php
$s = readline();

preg_match_all('/[aeiouAEIOU]/',$s,$matches);

echo count($matches[0]);
?>