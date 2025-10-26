<?php
$pesan = "saya Wong Tulungagung";
// echo strrev($pesan) . "</br>";

$perkata = explode(" ", $pesan);
$perkata = array_map(fn($pesan) => strrev($pesan), $perkata);
$pesan = implode(" ", $perkata);

echo $pesan. "</br>";
?>