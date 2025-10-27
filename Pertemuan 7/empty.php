<?php

$myArray = array();

if(empty($myArray)){
    echo "Array kosong";
}else{
    echo "Array tidak kosong";
}

echo "<br>";

if(empty($nonExistentVar)){
    echo "Variabel tidak di set atau kosong";
}else{
    echo "Variabel di set dan tidak kosong";
}

?>