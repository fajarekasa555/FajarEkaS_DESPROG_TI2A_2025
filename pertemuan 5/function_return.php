<?php

function hitungUmur($tahun_lahir, $tahun_sekarang) {
    $umur = $tahun_sekarang - $tahun_lahir;
    return $umur;
}

function perkenalan($nama, $salam = "Assalamualaikum") {
    echo $salam . ",<br/>";
    echo "Perkenalkan, nama saya " . $nama . "<br/>";

    echo "Saya berusia " . hitungUmur(2005, 2025) . " tahun<br/>";
    echo "Senang berkenalan dengan anda<br/>";
}

perkenalan("Killer Queen", "Ohayou gozaimasu");
?>