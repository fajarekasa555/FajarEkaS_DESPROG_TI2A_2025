<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $buah = $_POST['buah'];

    if(isset($_POST['warna'])) {
        $warna = $_POST['warna'];
    } else {
        $warna = [];
    }

    $jenis_kelamin = $_POST['kelamin'];

    echo "Anda memilih buah: " . htmlspecialchars($buah) . "<br>";

    if(!empty($warna)){
        echo "Warna yang dipilih: " . implode(", ", array_map('htmlspecialchars', $warna)) . "<br>";
    } else {
        echo "Tidak ada warna yang dipilih.<br>";
    }

    echo "Jenis kelamin yang dipilih: " . htmlspecialchars($jenis_kelamin) . "<br>";
}
?>