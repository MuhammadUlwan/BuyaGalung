<?php
include('../koneksi.php');

if (isset($_POST['submit'])) {
    $telepon = $_POST['telepon'];
    $password = $_POST['password'];

    // Gunakan parameterisasi query untuk mencegah SQL injection
    $query = "SELECT id_nama, telepon, password, role FROM user WHERE telepon = ? AND password = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "ss", $telepon, $password);
    mysqli_stmt_execute($stmt);

    // Periksa hasil query
    mysqli_stmt_store_result($stmt);
    $row_count = mysqli_stmt_num_rows($stmt);

    if ($row_count > 0) {
        mysqli_stmt_bind_result($stmt, $id_user, $telepon, $password, $role);

        while (mysqli_stmt_fetch($stmt)) {
            session_start();
            $_SESSION["login_user"] = $id_user;
            $_SESSION['id_nama'] = $id_user;
            if ($role == "admin") {
                header('location: ../admin/home_admin.php');
            } else if ($role == 'user') {
                header('location: ../user/page/home.php');
            } else {
                header('location: login.php');
            }
        }
    } else {
        echo "Login gagal. Periksa nomor handphone dan kata sandi Anda.";
    }

    // Tutup statement dan koneksi
    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/user.css">
        <title>Login</title>
    </head>

    <body>
        <div class="wrapper">
            <form action="" method="POST">
                <H1>LOGIN</H1>

                <div class="input-box">
                <input type="tel" placeholder="No Handphone" name="telepon">
                </div>

                <div class="input-box">
                <input type="password" placeholder="Password" name="password">
                </div>

                <div class="container-menu">
                    <button type="submit" name="submit" class="btn btn1">LOGIN</button>
                </div>

                <div class="register-link">
                    <p>Belum Punya Akun? <a href="daftar.php">Daftar</a></p>
                </div>
            </form>
        </div>
</body>
</html>

