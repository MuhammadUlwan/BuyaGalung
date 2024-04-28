<?php
include '../koneksi.php';
include 'header.php';

session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: ../form/login.php");
    exit();
}

$id_nama = isset($_SESSION['id_nama']) ? $_SESSION['id_nama'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = isset($_POST['nama']) ? mysqli_real_escape_string($koneksi, $_POST['nama']) : null;
    $telepon = isset($_POST['telepon']) ? $_POST['telepon'] : null;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($koneksi, $_POST['email']) : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    $query_update_user = "UPDATE user SET nama = '$nama', telepon = '$telepon', email = '$email', password = '$password' WHERE id_nama = '$id_nama'";
    $result_update_user = mysqli_query($koneksi, $query_update_user);

    if ($result_update_user) {
        echo "";
        // Redirect to account.php after successful update
        echo '<script>window.location.href = "account_admin.php";</script>';
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "Invalid request";
}

include 'footer.php';
?>
