<!-- verifikasi_transaksi.php -->
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

echo "<h2>Verifikasi Transaksi</h2>";
echo "<p>ID Transaksi: " . $row['id_transaksi'] . "</p>";
echo "<p>ID Pesan: " . $row['id_pesan'] . "</p>";
echo "<p>Nama Pengirim: " . $row['pengirim'] . "</p>";
echo "<p>Total Harga: " . $row['total_akhir'] . "</p>";
echo "<p>Status: " . $row['id_status'] . "</p>";

// Tombol Verifikasi dan Kirim
echo "<button onclick='verifikasi(" . $row['id_pesanan'] . ")'>Verifikasi</button>";
echo "<button onclick='kirim(" . $row['id_transaksi'] . ")'>Kirim</button>";

mysqli_close($koneksi);
include "footer.php";
?>

<script>
    function verifikasi(idTransaksi) {
        // Lakukan logika verifikasi, misalnya mengubah status menjadi "verifikasi"
        alert("Verifikasi transaksi dengan ID " + idTransaksi);
    }

    function kirim(idTransaksi) {
        // Lakukan logika pengiriman, misalnya mengubah status menjadi "dikirim"
        alert("Kirim transaksi dengan ID " + idTransaksi);
    }
</script>
