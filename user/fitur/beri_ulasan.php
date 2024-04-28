<?php
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: ../form/login.php");
    exit();
}

include('../../koneksi.php');
include '../function/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_menu']) && isset($_GET['kategori'])) {
    $id_menu = $_GET['id_menu'];
    $kategori = $_GET['kategori'];

    // Ambil nama menu berdasarkan id_menu
    $query_nama_menu = "SELECT nama_menu FROM menu WHERE id_menu = '$id_menu'";
    $result_nama_menu = mysqli_query($koneksi, $query_nama_menu);
    $row_nama_menu = mysqli_fetch_assoc($result_nama_menu);
    $nama_menu = $row_nama_menu['nama_menu'];

    ?>
    <title>Beri Ulasan</title>
    <main class="main">
        <form method="post" action="proses_ulasan.php" enctype="multipart/form-data">
            <div class="form-group">
                <p class="selected-menu" id="selected_menu"><?= $nama_menu ?></p>
                <input type="hidden" name="id_menu" value="<?= $id_menu ?>">
                <input type="hidden" name="kategori" value="<?= $kategori ?>">
            </div>

            <div class="form-group">
                <label for="foto_menu_path">Upload Foto:</label>
                <input type="file" name="foto_menu_path" id="foto_menu_path">
            </div>

            <div class="form-group">
                <label for="komentar">Beri Ulasan:</label>
                <textarea name="komentar" id="komentar" rows="4" cols="50"></textarea>
            </div>

            <div class="form-group">
                <label for="rating">Beri Rating:</label>
                <select name="rating" id="rating">
                    <option value="1">★</option>
                    <option value="2">★★</option>
                    <option value="3">★★★</option>
                    <option value="4">★★★★</option>
                    <option value="5">★★★★★</option>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" name="submit_review" value="Kirim Ulasan">
            </div>
        </form>
    </main>

    <?php
    include '../function/footer.php';
} else {
    echo "Invalid request";
}
?>
