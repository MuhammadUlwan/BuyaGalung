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

echo "<h2>Pesan Menu</h2>";
echo "<p>ID Transaksi: " . $row['id_transaksi'] . "</p>";
echo "<p>ID Pesanan: " . $row['id_pesanan'] . "</p>";
echo "<p>Nama: " . $row['nama'] . "</p>";
echo "<p>Total Harga: " . $row['total_harga'] . "</p>";
echo "<p>Status: " . $row['status'] . "</p>";

// Form Pemesanan
echo "<form action='proses_pesan.php' method='post'>";
echo "<input type='hidden' name='id_transaksi' value='" . $row['id_transaksi'] . "'>";

// Tampilkan menu yang bisa dipesan
$query_menu = "SELECT * FROM menu WHERE status_menu = 'tersedia'";
$result_menu = mysqli_query($koneksi, $query_menu);

if ($result_menu) {
    echo "<label for='menu'>Pilih Menu:</label>";
    echo "<select name='id_menu' id='menu'>";
    while ($row_menu = mysqli_fetch_assoc($result_menu)) {
        echo "<option value='" . $row_menu['id_menu'] . "'>" . $row_menu['nama_menu'] . " - Rp " . $row_menu['harga_menu'] . "</option>";
    }
    echo "</select>";

    echo "<label for='jumlah'>Jumlah Pesanan:</label>";
    echo "<input type='number' name='jumlah' id='jumlah' min='1' required>";

    echo "<button type='submit'>Pesan</button>";
} else {
    echo "Gagal mengambil data menu: " . mysqli_error($koneksi);
}

// Tampilkan link untuk melihat detail pesanan
echo "<a href='detail_pesanan.php?id_transaksi=" . $row['id_transaksi'] . "'>Lihat Detail Pesanan</a>";

mysqli_close($koneksi);
include "footer.php";
?>
