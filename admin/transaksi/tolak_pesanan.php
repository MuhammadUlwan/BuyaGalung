<?php
include "../../koneksi.php";

if (isset($_GET['id_transaksi'])) {
    $id_transaksi = $_GET['id_transaksi'];

    // Update the status to "ditolak"
    $query_tolak = "UPDATE transaksi SET status_transaksi = 'ditolak' WHERE id_transaksi = $id_transaksi";
    $result_tolak = mysqli_query($koneksi, $query_tolak);

    if ($result_tolak) {
        // Redirect back to transaksi.php after updating the status
        header("Location: transaksi.php");
        exit;
    } else {
        die("Gagal menolak pesanan. Error: " . mysqli_error($koneksi));
    }
} else {
    // Redirect to transaksi.php if id_transaksi is not set
    header("Location: transaksi.php");
    exit;
}
?>
