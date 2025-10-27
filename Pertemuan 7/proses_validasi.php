<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'] ?? '';
    $email = $_POST['email'] ?? '';

    if (empty($nama)) {
        echo "Nama tidak boleh kosong.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email tidak valid.";
        exit;
    }

    echo "Data berhasil dikirim! Nama: " . htmlspecialchars($nama) . ", Email: " . htmlspecialchars($email);
} else {
    echo "Form harus dikirim melalui POST.";
}
?>