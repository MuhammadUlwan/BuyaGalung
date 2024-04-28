<!-- proses_pembayaran.php -->
<?php
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data pembayaran dari form
    $id_transaksi = $_POST['id_transaksi'];
    $metode_pembayaran = $_POST['metode_pembayaran'];

    // Update status pembayaran di tabel transaksi
    $query_update = "UPDATE transaksi SET status = 'sudah dibayar' WHERE id_transaksi = $id_transaksi";
    $result_update = mysqli_query($koneksi, $query_update);

    if ($result_update) {
        // Redirect ke halaman transaksi setelah pembayaran berhasil
        header("location: transaksi.php");
        exit();
    } else {
        echo "Gagal mengupdate status pembayaran: " . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>
