<?php
// Mengatur tipe konten yang dikembalikan menjadi JSON
header('Content-Type: application/json');

// Memeriksa dan Membuat Token Keamanan (Jika Belum Ada)
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Mengambil headers permintaan
$headers = apache_request_headers();

// Memeriksa keberadaan dan validitas CSRF Token
if (isset($headers['Csrf-Token'])) {
    // Membandingkan token dari header AJAX dengan token SESSION
    if ($headers['Csrf-Token'] !== $_SESSION['csrf_token']) {
        // Token tidak cocok
        exit(json_encode(['error' => 'Wrong CSRF token.']));
    }
} else {
    // Token tidak ada di header
    exit(json_encode(['error' => 'No CSRF token.']));
}

// Jika kode mencapai titik ini, token valid, lanjutkan pemrosesan data.

?>