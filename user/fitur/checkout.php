<?php
session_start();

include('../../koneksi.php');

if (!isset($_SESSION['id_nama'])) {
    header("location: ../form/login.php");
    exit();
}

// Ambil data keranjang
$query_keranjang = "SELECT keranjang.*, menu.nama_menu, menu.harga_menu, menu.id_menu
                    FROM keranjang
                    INNER JOIN menu ON keranjang.id_menu = menu.id_menu
                    WHERE id_nama = " . $_SESSION['id_nama'];
$result_keranjang = mysqli_query($koneksi, $query_keranjang);

$total_harga = 0;

while ($row_keranjang = mysqli_fetch_assoc($result_keranjang)) {
    $total_harga += $row_keranjang['total_harga'];
}

// Set nilai total_harga ke dalam sesi
$_SESSION['total_harga'] = $total_harga;

include '../function/header.php';
?>

<title>Checkout</title>
<body>
    <main class="main">

        <form method="post" action="bayar.php">
            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" required>

            <label for="tanggal_pesan">Tanggal Pesan:</label>
            <input type="date" name="tanggal_pesan" required>

            <div class="total-harga-container">
                <label for="total_harga">Total Harga:</label>
                <p>Rp. <?php echo number_format($total_harga, 0, ',', '.'); ?></p>
            </div>

            <div class="pembayaran-container">
                <label>Pilih Pembayaran:</label>
                <div class="button-container">
                    <button type="submit" name="metode_pembayaran" value="DP">DP</button>
                    <button type="submit" name="metode_pembayaran" value="Lunas">LUNAS</button>
                </div>
            </div>
        </form>
    </main>
</body>

<?php include '../function/footer.php'; ?>
