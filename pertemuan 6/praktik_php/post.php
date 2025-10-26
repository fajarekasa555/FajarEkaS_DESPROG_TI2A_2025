<html>
<head>
    <title>Time Example</title>
</head>
<body>
    <form action="post.php" method="post">
        Nama: <input type="text" name="nama"><br>
        Alamat: <input type="text" name="alamat"><br>
        <input type="submit" value="Kirim">
    </form>

    <?php
    $nama = @$_POST['nama'];
    $alamat = @$_POST['alamat'];
    if($nama && $alamat){
        echo "Nama : $nama </br>";
        echo "Alamat : $alamat </br>";
    }else{
        echo "Silakan isi form di atas.";
    }
    ?>
</body>
</html>
