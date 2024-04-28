<?php
include "../../koneksi.php";
// aksi_transaksi.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_transaksi = $_POST['id_transaksi'];
    $status_transaksi = $_POST['status_transaksi'];

    // Lakukan validasi status_transaksi jika diperlukan

    // Update status_transaksi di database
    $query_update = "UPDATE transaksi SET status_transaksi = '$status_transaksi' WHERE id_transaksi = $id_transaksi";
    $result_update = mysqli_query($koneksi, $query_update);

    if ($result_update) {
        // Jika status_transaksi berubah menjadi 'selesai', tambahkan logika lain yang dibutuhkan
        if ($status_transaksi == 'selesai') {
            // Lakukan tindakan setelah transaksi selesai
        }

        // Berhasil mengubah status, kirim response ke client
        echo json_encode(['success' => true]);
    } else {
        // Gagal mengubah status, kirim response ke client
        echo json_encode(['success' => false]);
    }
} else {
    // Jika bukan request POST, kirim response ke client
    echo json_encode(['success' => false]);
}

?>
