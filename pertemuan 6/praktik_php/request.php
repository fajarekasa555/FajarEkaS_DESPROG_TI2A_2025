<html>
<head>
    <title>Resuest</title>
</head>
<body>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
        Nama: <input type="text" name="nama"><br>
        Alamat: <input type="text" name="alamat"><br>
        <input type="submit" value="Kirim">
    </form>

    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nama = @$_POST['nama'];
        $alamat = @$_POST['alamat'];
        if($nama && $alamat){
            echo "Nama : $nama </br>";
            echo "Alamat : $alamat </br>";
        }else{
            echo "Silakan isi form di atas.";
        }
    }
    ?>
</body>
</html>

