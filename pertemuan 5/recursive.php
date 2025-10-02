<?php

date_default_timezone_set('Asia/Jakarta');

// function tampilkanHaloDunia() {
//     echo "Halo Dunia!<br/>";
//     tampilkanHaloDunia();
// }

// tampilkanHaloDunia();

function tampilAngka($jumlah, $index = 1){
    echo "Perulangan ke-" . $index . "<br/>";
    if($index < $jumlah) {
        tampilAngka($jumlah, $index + 1);
    }
}

tampilAngka(25);
?>