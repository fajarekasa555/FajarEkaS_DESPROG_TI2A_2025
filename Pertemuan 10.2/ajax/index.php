<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Data Anggota</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="csrf-token" content="<?php echo $_SESSION['csrf_token']; ?>">
    
    <link rel="stylesheet" href="style.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php" style="color: white">BGD. Anggota</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h3>Input Data Anggota</h3>
        <hr>

        <form method="post" class="form-data" id="form-data">
            
            <div class="row">
                
                <div class="col-sm-9">
                    <div class="form-group">
                        <label for="id">Nama</label>
                        <input type="hidden" name="id" id="id"> 
                        <input type="text" name="nama" id="nama" class="form-control" required="true">
                        <p class="text-danger" id="err_nama"></p>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Jenis Kelamin</label><br>
                        <input type="radio" name="jenis_kelamin" id="jenkeli1" value="L" required="true"> Laki-laki
                        <input type="radio" name="jenis_kelamin" id="jenkeli2" value="P" required="true"> Perempuan
                        <p class="text-danger" id="err_jenis_kelamin"></p>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" required="true"></textarea>
                <p class="text-danger" id="err_alamat"></p>
            </div>
            
            <div class="form-group">
                <label for="no_telp">No Telepon</label>
                <input type="number" name="no_telp" id="no_telp" class="form-control" required="true"> 
                <p class="text-danger" id="err_no_telp"></p>
            </div>
            
            <div class="form-group">
                <button type="button" name="simpan" id="simpan" class="btn btn-primary">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </div>

        </form>

        <hr>
        
        <div id="data">
        </div>

        <div class="text-center mt-5">
            <small>Copyright <?php echo date('Y'); ?> | Desprog Media</small>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
    $(document).ready(function() {
        $('#data').load("data.php"); 
        $.ajaxSetup({
            headers: {
                'Csrf-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    
    $('#simpan').click(function() {
        var jenkeli1 = document.getElementById("jenkeli1").value;
        var jenkeli2 = document.getElementById("jenkeli2").value;
        var nama = document.getElementById("nama").value;
        var alamat = document.getElementById("alamat").value;
        var no_telp = document.getElementById("no_telp").value;

        if (nama == "") {
            document.getElementById("err_nama").innerHTML = "Nama Harus Diisi";
        } else {
            document.getElementById("err_nama").innerHTML = "";
        }
        
        if (alamat == "") {
            document.getElementById("err_alamat").innerHTML = "Alamat Harus Diisi";
        } else {
            document.getElementById("err_alamat").innerHTML = "";
        }
        
        if (document.getElementById("jenkeli1").checked == false && document.getElementById("jenkeli2").checked == false) {
            document.getElementById("err_jenis_kelamin").innerHTML = "Jenis Kelamin Harus Dipilih";
        } else {
            document.getElementById("err_jenis_kelamin").innerHTML = "";
        }
        
        if (no_telp == "") {
            document.getElementById("err_no_telp").innerHTML = "No Telepon Harus Diisi";
        } else {
            document.getElementById("err_no_telp").innerHTML = "";
        }

        if (nama != "" && alamat != "" && (document.getElementById("jenkeli1").checked == true || document.getElementById("jenkeli2").checked == true) && no_telp != "") {
            
            $.ajax({
                type: 'POST',
                url: "form_action.php",
                data: $('#form-data').serialize(),
                success: function(data) {
                    $('.data').load("data.php"); 
                    document.getElementById("form-data").reset();
                    document.getElementById("err_nama").innerHTML = "";
                    document.getElementById("err_alamat").innerHTML = "";
                    document.getElementById("err_jenis_kelamin").innerHTML = "";
                    document.getElementById("err_no_telp").innerHTML = "";
                },
                error: function(response) {
                    console.log(response.responseText);
                }
            });
        }
    });
    </script>
</body>
</html>