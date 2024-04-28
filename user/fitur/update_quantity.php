<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_quantity'])) {
    include('../../koneksi.php');

    $id_menu = $_POST['id_menu'];
    $action = $_POST['action']; // Mengambil data action (tambah/kurang)

    // Kode Anda yang sudah ada untuk memperbarui kuantitas dan total harga di sini

    // Kembalikan kuantitas dan total harga yang diperbarui dalam respons
    $response = array('quantity' => $new_quantity, 'total_harga' => $new_total_harga);
    echo json_encode($response);
    exit();
}
?>
