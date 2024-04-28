<?php
include '../../koneksi.php';
include '../function/header.php';

session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
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
        echo '<script>window.location.href = "account.php";</script>';
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "Invalid request";
}

include '../function/footer.php';
?>
