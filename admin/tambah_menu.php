<?php
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: ../form/login.php");
    exit();
}

include('../koneksi.php');

// Tombol Batal
if (isset($_POST['batal'])) {
    header("location: menu_admin.php");
    exit();
}           

// Fungsi Tambah Menu
if (isset($_POST['tambah_menu'])) {
    $kategori_menu = $_POST['kategori_menu'];
    $nama_menu = $_POST['nama_menu'];
    $harga_menu = $_POST['harga_menu'];
    $deskripsi_menu = $_POST['deskripsi_menu'];

    // Foto Menu
    $foto = $_FILES['foto_menu_path']['name'];
    $temp_name = $_FILES['foto_menu_path']['tmp_name'];
    $foto_dest = "" . $foto;

    move_uploaded_file($temp_name, $foto_dest);

    // Tambahkan kode 2: Cetak path gambar ke log
    error_log("Path gambar: " . $foto_dest);


    // Status Menu default 'tersedia' saat pertama kali ditambahkan
    $status_menu = 'tersedia';

    // SQL Query untuk menambahkan data ke tabel menu
    $query_tambah_menu = "INSERT INTO menu (kategori_menu, nama_menu, harga_menu, foto_menu_path, deskripsi, status_menu) 
                        VALUES ('$kategori_menu', '$nama_menu', '$harga_menu', '$foto_dest', '$deskripsi_menu', '$status_menu')";

    // Eksekusi query
    $result_tambah_menu = mysqli_query($koneksi, $query_tambah_menu);

    // Tambahkan kode 3: Cetak pesan kesalahan PHP (jika ada)
    if ($result_tambah_menu === false) {
        error_log("Error MySQL: " . mysqli_error($koneksi));
    }

    // Periksa apakah penambahan berhasil
    if ($result_tambah_menu) {
        header("location: menu_admin.php?status=success&message=Menu berhasil ditambahkan");
        exit();
    } else {
        header("location: tambah_menu.php?status=error&message=Gagal menambahkan menu. Error: " . mysqli_error($koneksi));
        exit();
    }
}

    include 'header.php';
?>

<title>Tambah Menu</title>
<head>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('formTambahMenu').addEventListener('submit', function (event) {
                if (!validateForm()) {
                    event.preventDefault();
                    alert('Harap isi semua kolom sebelum menyimpan menu.');
                }
            });

            document.getElementById('batalBtn').addEventListener('click', function () {
                window.location.href = 'menu_admin.php';
            });
        });

        function validateForm() {
            var kategori = document.getElementsByName('kategori_menu')[0].value;
            var nama = document.getElementsByName('nama_menu')[0].value;
            var harga = document.getElementsByName('harga_menu')[0].value;
            var foto = document.getElementsByName('foto_menu_path')[0].value;

            // Cek apakah semua kolom sudah terisi
            return kategori !== '' && nama !== '' && harga !== '' && foto !== '';
        }
    </script>
</head>
<body>
    <main class="main">
        <!-- Formulir Tambah Menu -->
    <form action="" method="post" enctype="multipart/form-data" id="formTambahMenu">
        <label for="kategori_menu">Kategori Menu:</label>
        <select name="kategori_menu" id="kategori_menu">
            <option value="PAKETAN">PAKETAN</option>
            <option value="PRASMANAN">PRASMANAN</option>
        </select>

        <label for="nama_menu">Nama Menu:</label>
        <input type="text" name="nama_menu" required>

        <label for="harga_menu">Harga Menu:</label>
        <input type="number" name="harga_menu" required>

        <label for="deskripsi_menu">Deskripsi Menu:</label>
        <textarea name="deskripsi_menu" rows="4" cols="50"></textarea>

        <label for="foto_menu_path">Foto Menu:</label>
        <input type="file" name="foto_menu_path" id="foto" accept="image/*">
        <br>
        <button type="submit" name="tambah_menu" id="tambahMenuBtn">Tambah Menu</button>
        <button type="button" name="batal" id="batalBtn">Batal</button>
    </form>
    </main>
</body>

<?php include 'footer.php'; ?>