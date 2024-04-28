<!-- proses_terima.php -->
<?php
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data transaksi dari form
    $id_transaksi = $_POST['id_transaksi'];

    // Update status transaksi menjadi "selesai"
    $query_update = "UPDATE transaksi SET status = 'selesai', terima_at = NOW() WHERE id_transaksi = $id_transaksi";
    $result_update = mysqli_query($koneksi, $query_update);

    if ($result_update) {
        // Redirect ke halaman transaksi setelah transaksi selesai
        header("location: transaksi.php");
        exit();
    } else {
        echo "Gagal mengupdate status transaksi: " . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>
