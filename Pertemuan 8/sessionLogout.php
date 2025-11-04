<?php
session_start();
session_destroy();

echo "Anda telah berhasil logout. <a href='sessionLoginForm.php'>Login kembali</a>.";
?>