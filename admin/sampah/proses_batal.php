<!-- proses_batal.php -->
<?php
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data transaksi dari form
    $id_transaksi = $_POST['id_transaksi'];

    // Update status transaksi menjadi "batal"
    $query_update = "UPDATE transaksi SET status = 'batal' WHERE id_transaksi = $id_transaksi";
    $result_update = mysqli_query($koneksi, $query_update);

    if ($result_update) {
        // Redirect ke halaman transaksi setelah transaksi dibatalkan
        header("location: transaksi.php");
        exit();
    } else {
        echo "Gagal mengupdate status transaksi: " . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>
