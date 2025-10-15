<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Array Terindeks</h2>
    <h3>Menampilkan array menggunakan Index</h3><br>
    <?php
        $list_dosen = ["Mr. Budi", "Mr. Iman", "Mr. Bagas"];

        echo $list_dosen[2]. "<br>";
        echo $list_dosen[0]. "<br>";
        echo $list_dosen[1]. "<br>";
    ?>
    <h3>Menampilkan array menggunakan Loop</h3><br>
    <?php
        foreach($list_dosen as $key => $dosen){
            echo $list_dosen[$key]. "<br>";
        }
    ?>
</body>
</html>