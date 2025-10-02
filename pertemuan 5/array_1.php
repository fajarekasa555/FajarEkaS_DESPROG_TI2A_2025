<!DOCTYPE html>
<html>
<head>
    <title>Array Terindeks</title>
</head>
<body>
    <h2>Array Terindeks</h2>
    <?php
        $Listdosen = ["Elok Nur Hamdana", "Unggul Pamenang", "Bagas Nugraha"];

        echo $Listdosen[2] . "<br>";
        echo $Listdosen[0] . "<br>";
        echo $Listdosen[1] . "<br>";

        echo "<br>";
        echo "<br>";

        echo "<br>Daftar Dosen memakai loop:<br>";
        foreach($Listdosen as $dosen) {
            echo $dosen . "<br>";
        }
    ?>
</body>
</html>