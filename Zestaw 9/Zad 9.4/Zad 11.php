<?php
$s = readline();

for ($i = 0; $i < strlen($s); $i++) {
    if (preg_match('/[aeiouAEIOU]/', $s[$i])) {
        echo '-' . $s[$i] . '-';
    } else echo $s[$i];
}

?>