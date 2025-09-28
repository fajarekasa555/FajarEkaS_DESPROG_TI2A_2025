<?php

$a = 10;
$b = 5;
$c = $a + 5;
$d = $b + (10 * 5);
$e = $d - $c;

echo "Variable a = $a <br>";
echo "Variable b = $b <br>";
echo "Variable c = $c <br>";
echo "Variable d = $d <br>";
echo "Variable e = $e <br>";
echo "<br>";
echo "<br>";

$nilaiMatematika = 5.1;
$nilaiIPA = 6.7;
$nilaiBahasaIndonesia = 9.3;

$rataRata = ($nilaiMatematika + $nilaiIPA + $nilaiBahasaIndonesia) / 3;

echo "Matematika: $nilaiMatematika <br>";
echo "IPA: $nilaiIPA <br>";
echo "Bahasa Indonesia: $nilaiBahasaIndonesia <br>";
echo "Rata-rata nilai: $rataRata <br>";
var_dump($rataRata);
echo "<br>";
echo "<br>";

$namaDepan = "Fajar";
$namaBelakang = 'Kopi';

$namaLengkap = "{$namaDepan} {$namaBelakang}";
$namaLengkap2 = $namaDepan . ' ' . $namaBelakang;

echo "Nama Depan: {$namaDepan} <br>";
echo 'Nama Belakang: ' .$namaBelakang. '<br>';
echo $namaLengkap;
echo "<br>";
echo "<br>";

$listMahasiswa = ["Fajar", "Kopi", "Jooow", "Kowie"];
echo $listMahasiswa[0];
echo "<br>";
?>