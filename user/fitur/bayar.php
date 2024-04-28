<?php
session_start();

include('../../koneksi.php');

if (!isset($_SESSION['id_nama'])) {
    header("location: ../form/login.php");
    exit();
}

// Inisialisasi variabel
$total_harga = 0;

// Jika metode pembayaran dipilih
if (isset($_POST['metode_pembayaran'])) {
    $metode_pembayaran = $_POST['metode_pembayaran'];

    // Ambil total_harga dari session
    $total_harga = isset($_SESSION['total_harga']) ? $_SESSION['total_harga'] : 0;

    // Potong 50% jika pembayaran DP
    if ($metode_pembayaran == 'DP') {
        $total_harga *= 0.5;
    }
}

// Jika tombol "Kirim" diklik
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kirim'])) {
    // Handle pengiriman formulir dan pembaruan database di sini

    // Hapus item di keranjang setelah transaksi selesai
    $query_delete_cart = "DELETE FROM keranjang WHERE id_nama = " . $_SESSION['id_nama'];
    mysqli_query($koneksi, $query_delete_cart);

    // Contohnya, sisipkan data ke tabel "transaksi"
    // Pastikan untuk membersihkan dan memvalidasi input pengguna sebelum dimasukkan ke database

    $gambar_transfer = $_FILES['gambar_transfer']['name'];
    
    // Ambil tanggal pesan dari form
    $tanggal_pesan = $_POST['tanggal_pesan'];

    // ... proses unggah file dan data formulir lainnya

    // Masukkan ke tabel transaksi
    $query = "INSERT INTO transaksi (id_nama, total_harga, gambar_transfer, tanggal_pesan, tanggal_transaksi, status_transaksi, metode_pembayaran)
              VALUES (?, ?, ?, ?, NOW(), 'pending', ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("idsds", $_SESSION['id_nama'], $total_harga, $gambar_transfer, $tanggal_pesan, $metode_pembayaran);

    // Jika berhasil memasukkan data ke tabel transaksi
    if ($stmt->execute()) {
        // Mungkin juga ingin memperbarui tabel lain atau melakukan tindakan tambahan

        // Redirect ke halaman admin atau tempat yang diinginkan
        header("location: ../page/home.php");
        exit();
    } else {
        // Handle kesalahan jika diperlukan
        echo "Gagal menyimpan transaksi ke database.";
    }

    // Tutup statement
    $stmt->close();
}

// Tampilkan formulir pembayaran
include '../function/header.php';
?>

<title>Pembayaran</title>
<body>
    <main class="main">

        <form method="post" action="" enctype="multipart/form-data">
            <label for="gambar_transfer">Upload Bukti Transfer:</label>
            <input type="file" name="gambar_transfer" required>
            
            <div style="display: flex; justify-content: space-between;">
                <label for="total_harga" style="margin: 0;">Total Harga:</label>
                <p style="margin: 0; text-align: right;">Rp. <?php echo number_format($total_harga, 0, ',', '.'); ?></p>
            </div>

            <br>
            <div style="text-align: center;">
                <p>Rekening: 0000 0000 0000 0000</p>
                <p>Silahkan Transfer dan Kirim Bukti Transfer Anda</p>
            </div>

            <div style="display: flex; justify-content: space-between; margin-top: 20px;">
                <button type="submit" name="kirim">Kirim</button>
                <button type="button" onclick="location.href='keranjang.php'" style="margin-left: 10px;">Batal</button>
            </div>
        </form>
    </main>
</body>

<?php 
include '../function/footer.php';
?>
