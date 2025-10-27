<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Dengan PHP</title>
</head>
<body>
    <h2>Contoh Form</h2>
    <form action="" method="POST">
        <label for="buah">Pilih Buah:</label>
        <select name="buah" id="buah">
            <option value="apel">Apel</option>
            <option value="jeruk">Jeruk</option>
            <option value="pisang">Pisang</option>
        </select>

        <br>

        <label for="warna">Pilih Warna:</label>
        <input type="checkbox" name="warna[]" id="merah" value="merah">
        <label for="merah">Merah</label>
        <input type="checkbox" name="warna[]" id="kuning" value="kuning">
        <label for="kuning">Kuning</label>
        <input type="checkbox" name="warna[]" id="hijau" value="hijau">
        <label for="hijau">Hijau</label>

        <br>

        <label for="kelamin">Pilih Jenis Kelamin :</label>
        <input type="radio" name="kelamin" id="laki-laki" value="laki-laki">
        <label for="laki-laki">Laki-laki</label>
        <input type="radio" name="kelamin" id="perempuan" value="perempuan">
        <label for="perempuan">Perempuan</label>

        <br>

        <input type="submit" value="Kirim">
    </form>

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
</body>
</html>