<?php
$targetDirectory = "images/";

if (!file_exists($targetDirectory)) {
    mkdir($targetDirectory, 0777, true);
}

if ($_FILES['images']['name'][0]) {
    $totalFiles = count($_FILES['images']['name']);
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");

    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = $_FILES['images']['name'][$i];
        $fileTmp = $_FILES['images']['tmp_name'][$i];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $targetFile = $targetDirectory . basename($fileName);

        if (in_array($fileType, $allowedExtensions)) {
            if (move_uploaded_file($fileTmp, $targetFile)) {
                echo "Gambar $fileName berhasil diunggah.<br>";
                echo "<img src='$targetFile' width='200' style='height:auto; margin:10px; border:1px solid #ccc;'><br>";
            } else {
                echo "Gagal mengunggah gambar $fileName.<br>";
            }
        } else {
            echo "Format file $fileName tidak diizinkan.<br>";
        }
    }
} else {
    echo "Tidak ada file yang diunggah.";
}
?>
