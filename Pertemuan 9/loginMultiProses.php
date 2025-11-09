<?php

    include 'koneksi.php';

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password';";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    if(isset($row['level'])){
        if ($row['level'] == 1){
            echo "Anda berhasil login sebagai admin, silahkan menuju ";
            echo '<a href="homeAdmin.php">Halaman Home</a>';
        } else if ($row['level'] == 2){
            echo "Anda berhasil login sebagai guest, silahkan menuju ";
            echo '<a href="homeGuest.php">Halaman Home</a>';
        } else {
            echo "Anda gagal login. Silahkan ";
            echo '<a href="loginForm.php">Login kembali</a>';
        }
    } else {
        echo "Anda gagal login. Silahkan ";
        echo '<a href="loginForm.php">Login kembali</a>';
    }


?>
