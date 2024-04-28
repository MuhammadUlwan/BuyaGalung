<?php
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: ../form/login.php");
    exit();
}
include "../../koneksi.php";
include 'header.php';
?>

<title>Detail Transaksi</title>

<body>
    <main class="main">

        <table border="1" style="width: 75%; margin: 0 auto; border-collapse: collapse; border: 1px solid black;">
            <thead>
                <tr>
                    <th style="width: 2%;">#</th>
                    <th style="width: 5%;">ID Pesanan</th>
                    <th style="width: 10%;">ID Menu</th>
                    <th style="width: 10%;">Telepon</th>
                    <th style="width: 30%;">Alamat</th>
                    <th style="width: 15%;">Quantity</th>
                    <th style="width: 10%;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
    <?php
    // Ambil ID Transaksi dari parameter URL
    $id_transaksi = $_GET['id_transaksi'];

    // Query untuk mendapatkan data detail_transaksi
    $query = "SELECT * FROM detail_transaksi WHERE id_transaksi = ?";

    // Gunakan prepared statement untuk mencegah SQL injection
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("i", $id_transaksi);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa apakah query berhasil dijalankan
    if (!$result) {
        die("Query gagal: " . $koneksi->error);
    }

    // Tampilkan data detail_transaksi
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td style='text-align: center;'>" . $row['id_detail_transaksi'] . "</td>";
        echo "<td style='text-align: center;'>" . $id_transaksi . "</td>";
        echo "<td style='text-align: center;'>" . $row['nama_menu'] . "</td>";
        echo "<td style='text-align: center;'>" . $row['telepon'] . "</td>";
        echo "<td style='text-align: center;'>" . $row['alamat_penerima'] . "</td>";
        echo "<td style='text-align: center;'>" . $row['quantity'] . "</td>";
        echo "<td style='text-align: center;'>" . $row['subtotal'] . "</td>";
        echo "<img src='" . $row['gambar_transfer'] . "' alt='Bukti Transfer' style='width: 100px; height: auto;'>";
        echo "</tr>";
    }
    ?>
</tbody>
        </table>
    </main>

    <!-- Tambahan: Script JavaScript untuk menangani aksi verifikasi dan kirim -->
    <script>
        // Fungsi untuk menangani verifikasi
        function verifikasi(idPesanan) {
            // Logika untuk verifikasi, misalnya munculkan form untuk upload foto transaksi
            alert("Verifikasi pesanan dengan ID " + idPesanan);
        }

        // Fungsi untuk menangani pengiriman
        function kirim(idPesanan) {
            // Logika untuk kirim, misalnya mengubah status menjadi "terkirim"
            alert("Kirim pesanan dengan ID " + idPesanan);
        }
    </script>

</body>

<?php include 'footer.php'; ?>
