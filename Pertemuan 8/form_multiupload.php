<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Unggah Dokumen</h2>
    <form action="proses_upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="images[]" id="" multiple="multiple" accept=".gif, .png, .jpg, .jpeg"><br><br>
        <input type="submit" name="submit" value="Unggah">
    </form>
</body>
</html>