<!-- detail_transaksi.php -->
<?php
include "header.php";
include "../koneksi.php";

// Ambil ID Transaksi dari parameter URL
$id_transaksi = $_GET['id_transaksi'];

// Query untuk mendapatkan data transaksi berdasarkan ID Transaksi
$query = "SELECT * FROM transaksi WHERE id_transaksi = $id_transaksi";
$result = mysqli_query($koneksi, $query);

// Periksa apakah query berhasil dijalankan
if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}

// Tampilkan data transaksi
$row = mysqli_fetch_assoc($result);

echo "<h2>Detail Pesanan</h2>";
echo "<p>ID Transaksi: " . $row['id_transaksi'] . "</p>";
echo "<p>ID Pesanan: " . $row['id_pesanan'] . "</p>";
echo "<p>Nama: " . $row['nama'] . "</p>";
echo "<p>Total Harga: " . $row['total_harga'] . "</p>";
echo "<p>Status: " . $row['status'] . "</p>";

// Tampilkan status pengiriman
echo "<p>Waktu Pesan: " . $row['pesan_at'] . "</p>";
echo "<p>Waktu Kirim: " . $row['kirim_at'] . "</p>";
echo "<p>Waktu Terima: " . $row['terima_at'] . "</p>";

// Tambahan: Tampilkan detail menu dari pesanan
$query_detail = "SELECT menu.*, transaksi_detail.kuantiti_total 
                 FROM transaksi_detail 
                 JOIN menu ON transaksi_detail.id_menu = menu.id_menu
                 WHERE transaksi_detail.id_transaksi = $id_transaksi";

$result_detail = mysqli_query($koneksi, $query_detail);

if ($result_detail) {
    echo "<h3>Detail Menu</h3>";
    echo "<ul>";
    while ($row_detail = mysqli_fetch_assoc($result_detail)) {
        echo "<li>" . $row_detail['nama_menu'] . " - Jumlah: " . $row_detail['kuantiti_total'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Gagal mengambil data menu: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
include "footer.php";
?>
