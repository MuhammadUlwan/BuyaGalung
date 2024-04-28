<!-- selesai.php -->
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

echo "<h2>Transaksi Selesai</h2>";
echo "<p>ID Transaksi: " . $row['id_transaksi'] . "</p>";
echo "<p>Nama: " . $row['nama'] . "</p>";
echo "<p>Total Harga: " . $row['total_harga'] . "</p>";
echo "<p>Status: " . $row['status'] . "</p>";

// Form Konfirmasi Selesai
echo "<form action='proses_selesai.php' method='post'>";
echo "<input type='hidden' name='id_transaksi' value='" . $row['id_transaksi'] . "'>";

echo "<button type='submit'>Konfirmasi Selesai</button>";
echo "</form>";

mysqli_close($koneksi);
include "footer.php";
?>
