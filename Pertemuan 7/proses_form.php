<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username)) {
        echo "Username tidak boleh kosong.";
        exit;
    }

    if (strlen($password) < 8) {
        echo "Password terlalu pendek, minimal 8 karakter.";
        exit;
    }

    echo "Registrasi berhasil! Username: " . htmlspecialchars($username);
} else {
    echo "Form harus dikirim melalui POST.";
}
?>
