<?php
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: ../form/login.php");
    exit();
}

include('../koneksi.php');

if (isset($_POST['edit_menu'])) {
    $id_menu = $_POST['id_menu'];
    $kategori_menu = $_POST['kategori_menu'];
    $nama_menu = $_POST['nama_menu'];
    $harga_menu = $_POST['harga_menu'];
    $deskripsi_menu = $_POST['deskripsi_menu']; // Ambil nilai deskripsi dari formulir
    $status_menu = $_POST['status_menu'];

    // Proses upload gambar baru jika ada
    if (!empty($_FILES['foto_menu_path']['name'])) {
        // Proses upload gambar baru
    } else {
        // Gunakan foto lama
        $foto_dest = $row_menu[0]['foto_menu_path'];
    }

    // Perbarui data menu ke database
    $query_edit_menu = "UPDATE menu SET kategori_menu = '$kategori_menu', nama_menu = '$nama_menu', harga_menu = '$harga_menu', 
                        deskripsi = '$deskripsi_menu', status_menu = '$status_menu' WHERE id_menu = '$id_menu'";

    // Eksekusi query
    $result_edit_menu = mysqli_query($koneksi, $query_edit_menu);

    // Periksa apakah pengeditan berhasil
    if ($result_edit_menu) {
        header("location: menu_admin.php?status=success&message=Menu berhasil diedit");
        exit();
    } else {
        header("location: edit_menu.php?id=$id_menu&status=error&message=Gagal mengedit menu. Error: " . mysqli_error($koneksi));
        exit();
    }
}
?>
