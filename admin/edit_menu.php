<?php
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: ../form/login.php");
    exit();
}

include('../koneksi.php');

$id_menu = $_GET['id'];

$deskripsi_menu = ''; // Inisialisasi deskripsi_menu

$query_get_menu = mysqli_query($koneksi, "SELECT * FROM menu WHERE id_menu = '$id_menu'");
$row_menu = mysqli_fetch_assoc($query_get_menu);

if (isset($_POST['edit_menu'])) {
    $kategori_menu = $_POST['kategori_menu'];
    $nama_menu = $_POST['nama_menu'];
    $harga_menu = $_POST['harga_menu'];
    $deskripsi_menu = $_POST['deskripsi_menu'];
    $status_menu = $_POST['status_menu'];

    // Foto Menu
    if ($_FILES['foto_menu_path']['name'] != "") {
        $foto_menu_path = $_FILES['foto_menu_path']['name'];
        $temp_name = $_FILES['foto_menu_path']['tmp_name'];
        $foto_dest = "uploads/" . $foto_menu_path;

        move_uploaded_file($temp_name, $foto_dest);
    } else {
        $foto_menu_path = $row_menu['foto_menu_path'];
    }

    $query_edit_menu = "UPDATE menu SET kategori_menu = '$kategori_menu', 
                        nama_menu = '$nama_menu', 
                        harga_menu = '$harga_menu', 
                        deskripsi = '$deskripsi_menu', 
                        foto_menu_path = '$foto_menu_path', 
                        status_menu = '$status_menu' 
                        WHERE id_menu = '$id_menu'";

    // Eksekusi query
    $result_edit_menu = mysqli_query($koneksi, $query_edit_menu);

    // Periksa apakah pengeditan berhasil
    if ($result_edit_menu) {
        echo '<script>alert("Menu berhasil diedit."); window.location.href = "menu_admin.php";</script>';
        exit;
    } else {
        echo "Gagal mengedit menu. Error: " . mysqli_error($koneksi);
    }
}
?>

<?php include "header.php"; ?>

<title>Edit Menu</title>
<body>
    <main class="main">
        <!-- Formulir Edit Menu -->
        <form action="edit_menu.php?id=<?php echo $id_menu; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_menu" value="<?php echo $row_menu['id_menu']; ?>">

            <label for="kategori_menu">Kategori Menu:</label>
            <select name="kategori_menu" id="kategori_menu">
                <option value="paketan" <?php echo ($row_menu['kategori_menu'] == 'paketan') ? 'selected' : ''; ?>>PAKETAN</option>
                <option value="prasmanan" <?php echo ($row_menu['kategori_menu'] == 'prasmanan') ? 'selected' : ''; ?>>PRASMANAN</option>
            </select>

            <label for="nama_menu">Nama Menu:</label>
            <input type="text" name="nama_menu" value="<?php echo $row_menu['nama_menu']; ?>" required>

            <label for="harga_menu">Harga Menu:</label>
            <input type="number" name="harga_menu" value="<?php echo $row_menu['harga_menu']; ?>" required>

            <label for="deskripsi_menu">Deskripsi Menu:</label>
            <textarea name="deskripsi_menu" rows="4" cols="50"><?php echo $row_menu['deskripsi']; ?></textarea>

            <label for="foto_menu_path">Foto Menu:</label>
            <input type="file" name="foto_menu_path" id="foto" accept="image/*">

            <label for="status_menu">Status Menu:</label>
            <select name="status_menu" id="status_menu">
                <option value="tersedia" <?php echo ($row_menu['status_menu'] == 'tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                <option value="kosong" <?php echo ($row_menu['status_menu'] == 'kosong') ? 'selected' : ''; ?>>Kosong</option>
            </select>

            <button type="submit" name="edit_menu" id="sls">Selesai</button>
            <a href="menu_admin.php" class="cancel">Batal</a>
        </form>
    </main>
</body>

<?php include "footer.php"; ?>
