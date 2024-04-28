<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_review'])) {
    include('../../koneksi.php');

    $id_menu = isset($_POST['id_menu']) ? $_POST['id_menu'] : null;
    $id_nama = isset($_SESSION['id_nama']) ? $_SESSION['id_nama'] : null;
    $rating = isset($_POST['rating']) ? $_POST['rating'] : null;
    $komentar = isset($_POST['komentar']) ? mysqli_real_escape_string($koneksi, $_POST['komentar']) : null;
    $tgl = date('Y-m-d H:i:s');

    // Periksa apakah id_menu yang akan dimasukkan sudah ada di tabel menu
    $query_check_menu = "SELECT id_menu FROM menu WHERE id_menu = '$id_menu'";
    $result_check_menu = mysqli_query($koneksi, $query_check_menu);

    if (!$result_check_menu) {
        echo "Error: " . mysqli_error($koneksi);
        exit();
    }

    if (mysqli_num_rows($result_check_menu) == 0) {
        echo "ID Menu tidak valid";
        exit();
    }

    // Simpan informasi file yang diunggah
    $nama_file = $_FILES['foto_menu_path']['name'];
    $ukuran_file = $_FILES['foto_menu_path']['size'];
    $tmp_file = $_FILES['foto_menu_path']['tmp_name'];

    // Direktori tempat menyimpan file yang diunggah
    $upload_dir = '../../admin/uploads/';

    // Generate nama unik untuk file
    $nama_file_unik = uniqid() . '-' . $nama_file;

    // Pindahkan file yang diunggah ke direktori yang ditentukan
    if (move_uploaded_file($tmp_file, $upload_dir . $nama_file_unik)) {
        // Simpan path foto ke dalam database
        $path_foto = $upload_dir . $nama_file_unik;

        // Simpan ulasan ke dalam tabel ulasan
        $query_simpan_ulasan = "INSERT INTO ulasan (id_nama, id_menu, rating, komentar, foto_menu_path, tgl) 
                                VALUES ('$id_nama', '$id_menu', '$rating', '$komentar', '$path_foto', '$tgl')";
        
        if (mysqli_query($koneksi, $query_simpan_ulasan)) {
            echo "Ulasan berhasil disimpan!";
            header("Location: ../page/ulasan.php"); // Redirect ke halaman ulasan.php
            exit();
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    } else {
        echo "Gagal mengunggah file";
    }

    mysqli_close($koneksi);
} else {
    echo "Invalid request";
}
?>
