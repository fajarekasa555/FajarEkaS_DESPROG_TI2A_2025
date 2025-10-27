<?php
$umur;
if(isset($umur) && $umur >= 18){
    echo "Anda sudah dewasa";
}else{
    echo "Anda belum dewasa atau variabel belum di set";
}

echo "<br>";

$data = ["nama" => "Raoh", "usia" => 23];

if(isset($data['nama'])){
    echo "Nama: " . $data['nama'];
}else{
    echo "Nama tidak tersedia";
}
?>