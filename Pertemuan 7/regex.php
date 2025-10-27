<?php
// $pattern = '/[0-9]+/';
// $text = 'This is a Sample Text 123!';

// if(preg_match($pattern, $text, $matches)){
//     echo "Teks mengandung angka: " . implode(", ", $matches) . "<br>";
// } else {
//     echo "Teks tidak mengandung angka.";
// }


// $pattern = '/apple/';
// $replacement = 'banana';
// $text = 'I like apple pie and apple juice.';
// $result = preg_replace($pattern, $replacement, $text);
// echo $result;

// $pattern = '/go*d/';
// $text = 'god is good';
// if(preg_match_all($pattern, $text, $matches)){
//     echo "Ditemukan kecocokan: " . implode(", ", $matches[0]) . "<br>";
// } else {
//     echo "Tidak ada kecocokan ditemukan.";
// }

// $pattern = '/go?d/';
// $text = 'gd god good';
// if(preg_match_all($pattern, $text, $matches)){
//     echo "Ditemukan kecocokan: " . implode(", ", $matches[0]) . "<br>";
// } else {
//     echo "Tidak ada kecocokan ditemukan.";
// }


$pattern = '/go{1,2}d/';
$text = 'gd god good goood';
if(preg_match_all($pattern, $text, $matches)){
    echo "Ditemukan kecocokan: " . implode(", ", $matches[0]) . "<br>";
} else {
    echo "Tidak ada kecocokan ditemukan.";
}

?>