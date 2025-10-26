<?php
$lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";

echo "<p>{$lorem}</p>";
echo "Panjang karakter :" . strlen($lorem) . "</br>";
echo "Jumlah kata :" . str_word_count($lorem) . "</br>";
echo "<p>" . strtoupper($lorem) . "</p>";
echo "<p>" . strtolower($lorem) . "</p>";
?>