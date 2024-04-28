<!-- proses_pesan.php -->
<?php
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data pesanan dari form
    $id_transaksi = $_POST['id_transaksi'];
    $id_menu = $_POST['id_menu'];
    $jumlah = $_POST['jumlah'];

    // Query untuk menyimpan pesanan ke dalam tabel transaksi_detail
    $query_insert = "INSERT INTO transaksi_detail (id_pesanan, id_menu, kuantiti_total, pesan_at) 
                     VALUES ('$id_transaksi', '$id_menu', '$jumlah', NOW())";

    $result_insert = mysqli_query($koneksi, $query_insert);

    if ($result_insert) {
        // Update total harga di tabel transaksi
        $query_update = "UPDATE transaksi 
                         SET total_harga = total_harga + (SELECT harga_menu * $jumlah FROM menu WHERE id_menu = $id_menu) 
                         WHERE id_transaksi = $id_transaksi";

        $result_update = mysqli_query($koneksi, $query_update);

        if ($result_update) {
            header("location: transaksi.php");
            exit();
        } else {
            echo "Gagal mengupdate total harga: " . mysqli_error($koneksi);
        }
    } else {
        echo "Gagal menyimpan pesanan: " . mysqli_error($koneksi);
    }
}

mysqli_close($koneksi);
?>
