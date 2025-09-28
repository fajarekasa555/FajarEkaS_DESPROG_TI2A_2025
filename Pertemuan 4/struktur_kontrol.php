<?php
$nilaiNumerik = 92;

if ($nilaiNumerik >= 90 && $nilaiNumerik <= 100) {
    $grade = 'A';
} elseif ($nilaiNumerik >= 80 && $nilaiNumerik < 90) {
    $grade = 'B';
} elseif ($nilaiNumerik >= 70 && $nilaiNumerik < 80) {
    $grade = 'C';
} elseif ($nilaiNumerik < 70) {
    $grade = 'D';
}

echo "Nilai numerik: $nilaiNumerik <br>";
echo "Grade: $grade <br>";
echo "<br>";
echo "<br>";

$jarakSaatIni = 0;
$jarakTarget = 500;
$peningkatanHarian = 30;
$hari = 0;

while ($jarakSaatIni < $jarakTarget) {
    $jarakSaatIni += $peningkatanHarian;
    $hari++;
}

echo "Jumlah hari yang dibutuhkan untuk mencapai jarak $jarakTarget km: $hari hari<br>";
echo "<br>";
echo "<br>";

$jumlahLahan = 10;
$tanamanPerlahan = 5;
$buahPerTanaman = 10;
$jumlahBuah = 0;

for ($i = 1; $i <= $jumlahLahan; $i++) {
    $jumlahBuah += ($tanamanPerlahan * $buahPerTanaman);
}

echo "Jumlah buah yang akan dipanen dari $jumlahLahan lahan adalah: $jumlahBuah buah<br>";

echo "<br>";
echo "<br>";

$skorUjian = [85, 92, 78, 96, 88];
$totalSkor = 0;

foreach ($skorUjian as $skor) {
    $totalSkor += $skor;
}

echo "Total skor ujian: $totalSkor<br>";
echo "<br>";
echo "<br>";

$nilaiSiswa = [85, 92, 58, 64, 90, 55, 88, 79, 70, 96];

foreach ($nilaiSiswa as $key => $nilai){
    if($nilai < 60){
        echo "Siswa ke-" . ($key + 1) . "<br>";
        echo "Nilai $nilai: Tidak Lulus<br>";
    }else{
        echo "Siswa ke-" . ($key + 1) . "<br>";
        echo "Nilai $nilai: Lulus<br>";
        echo "<br>";
    }
}

echo "<br>";
echo "<br>";

$nilaiSiswa = [85, 92, 78, 64, 90, 75, 88, 79, 70, 96];

// Urutkan array
sort($nilaiSiswa);

// Buang 2 nilai terendah
array_shift($nilaiSiswa);
array_shift($nilaiSiswa);

// Buang 2 nilai tertinggi
array_pop($nilaiSiswa);
array_pop($nilaiSiswa);

// Hitung total nilai yang tersisa
$totalNilai = array_sum($nilaiSiswa);

// Hitung rata-rata
$rataRata = $totalNilai / count($nilaiSiswa);

echo "Total nilai setelah buang 2 tertinggi & 2 terendah = $totalNilai <br>";
echo "Rata-rata nilai setelah buang 2 tertinggi & 2 terendah = $rataRata <br>";

echo "<br>";
echo "<br>";

$hargaProduk = 120000;
$diskon = 0;

if ($hargaProduk > 100000) {
    $diskon = 0.2;
}

$hargaAkhir = $hargaProduk - ($hargaProduk * $diskon);

echo "Harga produk: Rp $hargaProduk <br>";
echo "Diskon: " . ($diskon * 100) . "%<br>";
echo "Harga yang harus dibayar setelah diskon: Rp $hargaAkhir <br>";
echo "<br>";
echo "<br>";

$totalPoin = 600;

echo "Total skor pemain adalah: $totalPoin<br>";
echo "Apakah pemain mendapatkan hadiah tambahan? " . ($totalPoin > 500 ? "YA" : "TIDAK") . "<br>";
?>