<?php
$username = $_POST['username'];
$password = $_POST['password'];

if($username === 'admin' && $password === '1234') {
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['status'] = 'login';
    echo "Login berhasil. Welcome, " . $_SESSION['username'] . "! <a href='homeSession.php'>Lanjut ke halaman Home</a>";
} else {
    echo "Login gagal. Username atau password salah. silakan coba lagi. <a href='sessionLoginForm.php'>Kembali ke halaman login</a>";
}
?>