<?php

function perkenalan($nama, $salam="Assalamu'alaikum") {
    echo "$salam, ";
    echo "Perkenalkan, nama saya $nama.<br/>";
    echo "Senang berkenalan dengan anda.<br/>";
}

perkenalan("Fajar Eka Sandi", "Konnichiwa");

echo "<hr/>";

$saya = "Mr. F";
$salam = "Ohayou gozaimasu";

perkenalan($saya);
?>