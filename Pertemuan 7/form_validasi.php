<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>
    <form action="proses_form.php" method="POST" id="form">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama">
        <span id="namaError" style="color: red;"></span>
        <br>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
        <span id="emailError" style="color: red;"></span>
        <br>
        <input type="submit" value="Kirim">
    </form>

    <script>
        $(document).ready(function(){
            $("#form").submit(function(event){
                var nama = $("#nama").val().trim();
                var email = $("#email").val().trim();
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                var valid = true;

                if(nama === ""){
                    $("#namaError").text("Nama harus diisi.");
                    valid = false;
                } 
                
                if(email === ""){
                    $("#emailError").text("Email harus diisi.");
                    valid = false;
                } else if(!emailPattern.test(email)){
                    $("#emailError").text("Format email tidak valid.");
                    valid = false;
                }else{
                    $("#namaError").text("");
                    $("#emailError").text("");
                }

                if(!valid){
                    event.preventDefault();
                }
            });
        })
    </script>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form AJAX + Validasi Password</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <style>
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h2>Form Registrasi</h2>
    <form id="registerForm">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <span id="usernameError" class="error"></span>
        <br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <span id="passwordError" class="error"></span>
        <br><br>

        <input type="submit" value="Kirim">
    </form>

    <div id="result"></div>

    <script>
    $(document).ready(function(){
        $("#registerForm").submit(function(event){
            event.preventDefault();

            var username = $("#username").val().trim();
            var password = $("#password").val().trim();
            var valid = true;

            $("#usernameError").text("");
            $("#passwordError").text("");
            $("#result").text("");

            if(username === ""){
                $("#usernameError").text("Username harus diisi.");
                valid = false;
            }

            if(password.length < 8){
                $("#passwordError").text("Password minimal 8 karakter.");
                valid = false;
            }

            if(!valid) return;

            $.ajax({
                url: "proses_form.php",
                type: "POST",
                data: { username: username, password: password },
                success: function(response){
                    $("#result").html('<span class="success">' + response + '</span>');
                    $("#registerForm")[0].reset();
                },
                error: function(){
                    $("#result").html('<span class="error">Terjadi kesalahan saat mengirim data.</span>');
                }
            });
        });
    });
    </script>
</body>
</html>
