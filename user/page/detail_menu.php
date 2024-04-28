<?php
session_start();
include('../../koneksi.php');

// Ambil ID menu dari parameter URL
$id_menu = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_menu) {
    // Query untuk mendapatkan informasi menu berdasarkan ID
    $query_detail = "SELECT id_menu, nama_menu, harga_menu, deskripsi, foto_menu_path FROM menu WHERE id_menu = $id_menu";
    $result_detail = mysqli_query($koneksi, $query_detail);

    // Pastikan ID menu valid
    if (mysqli_num_rows($result_detail) > 0) {
        $row_detail = mysqli_fetch_assoc($result_detail);

        include '../function/header.php';
?>

<title>Detail Menu</title>
<style>
    .detail-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .detail-container img {
        width: 100%;
        max-height: 300px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .detail-container h2 {
        color: #333;
        margin-bottom: 5px;
    }

    .detail-container p {
        color: #555;
        margin-bottom: 10px;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #11A100;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    }

    .btn:hover {
        background-color: #4A1260;
    }
</style>
<body>
    <main class="main">
        <div class="detail-container">
            <img src="../../admin/uploads/<?php echo $row_detail['foto_menu_path']; ?>" alt="<?php echo $row_detail['nama_menu']; ?>">
            <h2><?php echo $row_detail['nama_menu']; ?></h2>
            <p>Rp. <?php echo number_format($row_detail['harga_menu'], 0, ',', '.'); ?></p>
            <p><?php echo $row_detail['deskripsi']; ?></p>

            <!-- Tombol "Kembali" -->
            <a href="menu.php" class="btn">Kembali</a>
        </div>
    </main>

<?php
        include '../function/footer.php';
    } else {
        // ID menu tidak valid, redirect atau tampilkan pesan kesalahan
        header("location: menu.php");
    }
} else {
    // Parameter ID menu tidak ada, redirect atau tampilkan pesan kesalahan
    header("location: menu.php");
}
?>
