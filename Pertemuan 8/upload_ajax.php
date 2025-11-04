<?php
if(isset($_FILES['file'])){
    $errors = array();
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    @$file_ext = strtolower("" . end(explode('.', $_FILES['file']['name'])) . "");
    $extensions = array("png", "jpg", "jpeg", "gif", "doc", "txt", "pdf", "docx");

    if(in_array($file_ext, $extensions) === false){
        $errors[] = "jenis file yang diizinkan adalah PNG, JPG, JPEG, GIF, DOC, TXT, PDF, atau DOCX.";
    }

    if($file_size > 2097152){
        $errors[] = 'Ukuran file harus kurang dari 2 MB';
    }

    if(empty($errors) == true){
        move_uploaded_file($file_tmp, "uploads/" . $file_name);
        echo "File berhasil diunggah: " . $file_name;
    } else {
        foreach($errors as $error){
            echo $error . "<br>";
        }
    }
}
?>