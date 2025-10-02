<?php
date_default_timezone_set('Asia/Jakarta');
$pesan = "Watashi wa nihonjin njanai.";

$pesanPerKata = explode(" ", $pesan);

$pesanPerKata = array_map(function($pesan) { return strrev($pesan); }, $pesanPerKata);
$pesan = implode(" ", $pesanPerKata);

echo $pesan;
?>