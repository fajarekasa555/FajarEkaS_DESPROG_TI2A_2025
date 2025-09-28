<?php
$a = 10;
$b = 5;

$hasilTambah = $a + $b;
$hasilKurang = $a - $b;
$hasilKali = $a * $b;
$hasilBagi = $a / $b;
$hasilModulus = $a % $b;
$hasilPerpangkatan = $a ** $b;

echo "Hasil Penjumlahan: $a + $b = $hasilTambah <br>";
echo "Hasil Pengurangan: $a - $b = $hasilKurang <br>";
echo "Hasil Perkalian: $a * $b = $hasilKali <br>";
echo "Hasil Pembagian: $a / $b = $hasilBagi <br>";
echo "Hasil Modulus: $a % $b = $hasilModulus <br>";
echo "Hasil Perpangkatan: $a ** $b = $hasilPerpangkatan <br>";
echo "<br>";
echo "<br>";

$hasilSama = ($a == $b);
$hasilTidakSama = ($a != $b);
$hasilLebihBesar = ($a > $b);
$hasilKurangDari = ($a < $b);
$hasilLebihBesarSamaDengan = ($a >= $b);
$hasilKurangDariSamaDengan = ($a <= $b);

echo "Apakah $a sama dengan $b? " . ($hasilSama ? 'true' : 'false') . "<br>";
echo "Apakah $a tidak sama dengan $b? " . ($hasilTidakSama ? 'true' : 'false') . "<br>";
echo "Apakah $a lebih besar dari $b? " . ($hasilLebihBesar ? 'true' : 'false') . "<br>";
echo "Apakah $a kurang dari $b? " . ($hasilKurangDari ? 'true' : 'false') . "<br>";
echo "Apakah $a lebih besar atau sama dengan $b? " . ($hasilLebihBesarSamaDengan ? 'true' : 'false') . "<br>";
echo "Apakah $a kurang dari atau sama dengan $b? " . ($hasilKurangDariSamaDengan ? 'true' : 'false') . "<br>";
echo "<br>";
echo "<br>";

$hasilAnd = $a && $b;
$hasilOr = $a || $b;
$hasilNotA = !$a;
$hasilNotB = !$b;

echo "Hasil AND (a && b): " . ($hasilAnd ? 'true' : 'false') . "<br>";
echo "Hasil OR (a || b): " . ($hasilOr ? 'true' : 'false') . "<br>";
echo "Hasil NOT a (!a): " . ($hasilNotA ? 'true' : 'false') . "<br>";
echo "Hasil NOT b (!b): " . ($hasilNotB ? 'true' : 'false') . "<br>";
echo "<br>";
echo "<br>";

$a += $b;
$a -= $b;
$a *= $b;
$a /= $b;
$a %= $b;

echo "Nilai a setelah a += b: $a <br>";
echo "Nilai a setelah a -= b: $a <br>";
echo "Nilai a setelah a *= b: $a <br>";
echo "Nilai a setelah a /= b: $a <br>";
echo "Nilai a setelah a %= b: $a <br>";
echo "<br>";
echo "<br>";

$hasilIdentik = $a === $b;
$hasilTidakIdentik = $a !== $b;

echo "Apakah $a identik dengan $b? " . ($hasilIdentik ? 'true' : 'false') . "<br>";
echo "Apakah $a tidak identik dengan $b? " . ($hasilTidakIdentik ? 'true' : 'false') . "<br>";
echo "<br>";
echo "<br>";

$totalKursi = 45;
$kursiTerisi = 28;

// Hitung kursi kosong
$kursiKosong = $totalKursi - $kursiTerisi;

// Hitung persentase kursi kosong
$persentaseKosong = ($kursiKosong / $totalKursi) * 100;

echo "Total kursi: $totalKursi <br>";
echo "Kursi terisi: $kursiTerisi <br>";
echo "Kursi kosong: $kursiKosong <br>";
echo "Persentase kursi kosong: $persentaseKosong %<br>";
?>