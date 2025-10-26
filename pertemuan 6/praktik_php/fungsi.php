<?php


function hitungUmr($tgl_lahir, $now){
    $umur = $now - $tgl_lahir;
    return $umur;
}

function perkenalan($nama, $salam = "Assalamualaikum"){
    echo $salam . "</br>";
    echo "Perkenalkan aku $nama </br>";
    echo "Aku suka makan nasi goreng</br>";
    echo "Aku adalah manusia ikan</br>";
    echo "Aku berusia " . hitungUmr(240, 2024) . " tahun</br>";
    echo "Senang berkenalan denganmu!</br>";
}

perkenalan("Fajar", "Assalamualaikum");

echo "<hr>";



?>