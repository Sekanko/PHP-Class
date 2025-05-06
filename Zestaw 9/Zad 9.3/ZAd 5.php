<?php
$one = str_split(readline());
$two = str_split(readline());

for($i = 0; $i < sizeof($one); $i++){
    if($one[$i] != $two[$i]){
        $pos = $i;
        break;
    }
}

if(isset($pos)){
    echo $pos;
} else echo "The strings are equal";

?>