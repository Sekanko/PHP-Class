<?php
$t = readline();
$w = readline();

for ($i = 0; $i < 3; $i++) {
    switch ($i) {
        case 1:
            $w = strtoupper($w);
            break;
        case 2:
            $w = strtolower($w);
            break;
    }

    while (strpos($t,$w) !== false){
        $t = substr_replace($t,'', strpos($t,$w),strlen($w)+1);
    }
}

echo $t;
?>