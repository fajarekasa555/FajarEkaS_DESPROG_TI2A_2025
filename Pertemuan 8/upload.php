<?php
 if(isset($_POST["submit"])){
    $targetdir = "uploads/";
    $targetfile = $targetdir . basename($_FILES["myfile"]["name"]);
    $fileType = strtolower(pathinfo($targetfile, PATHINFO_EXTENSION));

    $allowedExtentions = array("txt", "pdf", "doc", "docx");
    $maxSize = 3 * 1024 * 1024;

    if(in_array($fileType, $allowedExtentions)){
        if($_FILES["myfile"]["size"] <= $maxSize){
            if(move_uploaded_file($_FILES["myfile"]["tmp_name"], $targetfile)){
                echo "The file ". htmlspecialchars(basename($_FILES["myfile"]["name"])). " has been uploaded.";

                echo "<h3>Preview File:</h3>";
                echo "<iframe src='$targetfile' width='200' style='height:auto; border:1px solid #ccc; margin-top:10px;'></iframe>";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, your file is too large.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
 }
?>