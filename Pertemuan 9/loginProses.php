<?php
include "koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result = mysqli_query($koneksi, $query);
$cek = mysqli_num_rows($result);

if ($cek > 0) {
    echo "Anda berhasil login. Silahkan menuju ";
    echo '<a href="homeAdmin.php">Halaman HOME</a>';
} else {
    echo "Anda gagal login. Silahkan ";
    echo '<a href="loginForm.php">Login kembali</a>';
}

// Cek jika ada error query
if (mysqli_error($koneksi)) {
    echo "<br><b>Error:</b> " . mysqli_error($koneksi);
}
?>
