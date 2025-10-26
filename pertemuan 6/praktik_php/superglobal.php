<?php

// echo json_encode($_SERVER, JSON_PRETTY_PRINT);

$nama = @$_GET['nama'];
$alamat = @$_GET['alamat'];

echo "Nama : $nama </br>";
echo "Alamat : $alamat </br>";
?>