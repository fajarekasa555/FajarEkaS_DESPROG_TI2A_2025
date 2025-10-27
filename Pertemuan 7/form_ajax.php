<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Dengan PHP</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>
<body>
    <h2>Contoh Form</h2>
    <form action="" method="POST">
        <label for="buah">Pilih Buah:</label>
        <select name="buah" id="buah">
            <option value="apel">Apel</option>
            <option value="jeruk">Jeruk</option>
            <option value="pisang">Pisang</option>
        </select>

        <br>

        <label for="warna">Pilih Warna:</label>
        <input type="checkbox" name="warna[]" id="merah" value="merah">
        <label for="merah">Merah</label>
        <input type="checkbox" name="warna[]" id="kuning" value="kuning">
        <label for="kuning">Kuning</label>
        <input type="checkbox" name="warna[]" id="hijau" value="hijau">
        <label for="hijau">Hijau</label>

        <br>

        <label for="kelamin">Pilih Jenis Kelamin :</label>
        <input type="radio" name="kelamin" id="laki-laki" value="laki-laki">
        <label for="laki-laki">Laki-laki</label>
        <input type="radio" name="kelamin" id="perempuan" value="perempuan">
        <label for="perempuan">Perempuan</label>

        <br>

        <input type="submit" value="Kirim">
    </form>

    <script>
        $(document).ready(function(){
            $("form").submit(function(event){
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: "proses_lanjut.php",
                    type: "POST",
                    data: formData,
                    success: function(response){
                        $("body").append("<div>" + response + "</div>");
                    },
                    error: function(){
                        alert("Terjadi kesalahan saat mengirim data.");
                    }
                });
            });
        });
    </script>
</body>
</html>