<?php
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: ../form/login.php");
    exit();
}

include('../../koneksi.php');

if (isset($_GET['kategori'])) {
    $kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

    // Persiapkan statement SQL untuk mendapatkan menu sesuai dengan kategori
    $query_menu = "SELECT id_menu, nama_menu FROM menu WHERE kategori_menu = ?";
    
    // Persiapkan statement menggunakan prepared statement
    if ($stmt = mysqli_prepare($koneksi, $query_menu)) {
        // Bind parameter kategori sebagai string
        mysqli_stmt_bind_param($stmt, "s", $kategori);

        // Eksekusi prepared statement
        mysqli_stmt_execute($stmt);

        // Bind result variable
        mysqli_stmt_bind_result($stmt, $id_menu, $nama_menu);

        // Fetch hasil
        $menuOptions = array();
        while (mysqli_stmt_fetch($stmt)) {
            $menuOptions[] = array("id_menu" => $id_menu, "nama_menu" => $nama_menu);
        }

        // Tutup statement
        mysqli_stmt_close($stmt);

        // Mengembalikan data dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($menuOptions);
    } else {
        // Jika ada kesalahan pada prepared statement
        echo "Kesalahan pada prepared statement";
    }
} else {
    // Jika tidak ada kategori yang diberikan
    echo "Kategori tidak valid";
}
?>
