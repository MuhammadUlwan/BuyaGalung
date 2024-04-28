<?php 
include('../koneksi.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/user.css">
        <title>Daftar</title>
    </head>

    <body>
        <div class="wrapper">
            <form action="simpan_registrasi.php" method="POST">
                <H1>DAFTAR</H1>
                <div class="input-box">
                    <input type="text" placeholder="Nama Lengkap" name="nama">
                    </div>

                <div class="input-box">
                <input type="tel" placeholder="No Handphone" name="telepon">
                </div>

                <div class="input-box">
                <input type="email" placeholder="Email" name="email">
                </div>

                <div class="input-box">
                    <input type="password" placeholder="Password" name="password" required>
                </div>

                    
                    <div class="container-menu">
                        <button type="registrasi" class="btn btn1">DAFTAR</button>
                    </div>

                <div class="register-link">
                    <p>Sudah Punya Akun? <a href="login.php">Masuk</a></p>
                </div>
            </form>
        </div>
</body>
</html>