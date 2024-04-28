<?php
session_start();
include('../koneksi.php');

if (isset($_GET['id'])) {
    $id_menu = $_GET['id'];

    // SQL Query untuk menghapus data dari tabel menu
    $query_hapus_menu = "DELETE FROM menu WHERE id_menu = $id_menu";

    // Eksekusi query
    $result_hapus_menu = mysqli_query($koneksi, $query_hapus_menu);

    // Periksa apakah penghapusan berhasil
    if ($result_hapus_menu) {
        echo "Menu berhasil dihapus.";
    } else {
        echo "Gagal menghapus menu. Error: " . mysqli_error($koneksi);
    }
} else {
    echo "ID menu tidak valid.";
}

// Redirect kembali ke menu_admin.php setelah menghapus menu
header("location: menu_admin.php");
exit();
?>