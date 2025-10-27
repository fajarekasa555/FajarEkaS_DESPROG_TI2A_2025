

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <label for="input">Input:</label>
        <input type="text" id="input" name="input" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <input type="submit" value="Kirim">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input = $_POST['input'] ?? '';
        $email = $_POST['email'] ?? '';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email tidak valid.<br>";
        } else {
            echo "Email valid.<br>";
        }
        echo "Input: " . htmlspecialchars($input) . "<br>";
        echo "Email: " . htmlspecialchars($email) . "<br>";
    }
    ?>
</body>
</html>