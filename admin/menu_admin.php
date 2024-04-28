<?php
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: menu_admin.php");
    exit();
}

include('../koneksi.php');

// Fungsi Tambah Menu
if (isset($_POST['tambah_menu'])) {
    $kategori_menu = $_POST['kategori_menu'];
    $nama_menu = $_POST['nama_menu'];
    $harga_menu = $_POST['harga_menu'];

    // Foto Menu
    $foto_menu_path = $_FILES['foto_menu_path']['name'];
    $temp_name = $_FILES['foto_menu_path']['tmp_name'];
    $foto_dest = "uploads/" . $foto_menu_path;
    
    move_uploaded_file($temp_name, $foto_dest);

    // SQL Query untuk menambahkan data ke tabel menu
    $query_tambah_menu = "INSERT INTO menu (kategori_menu, nama_menu, harga_menu, foto_menu_path, status_menu) 
                          VALUES ('$kategori_menu', '$nama_menu', '$harga_menu', '$foto_menu_path', 'tersedia')";

    // Eksekusi query
    $result_tambah_menu = mysqli_query($koneksi, $query_tambah_menu);

    // Periksa apakah penambahan berhasil
    if ($result_tambah_menu) {
        echo "Menu berhasil ditambahkan.";
    } else {
        echo "Gagal menambahkan menu. Error: " . mysqli_error($koneksi);
    }
}

// Fungsi Tampilkan Menu
if (isset($_GET['kategori'])) {
    $kategori_terpilih = strtoupper($_GET['kategori']); // Ubah ke huruf besar
    $query_tampil = "SELECT * FROM menu WHERE kategori_menu = '$kategori_terpilih'";
} else {
    $kategori_terpilih = 'PAKETAN'; // Default kategori prasmanan
    $query_tampil = "SELECT * FROM menu WHERE kategori_menu = '$kategori_terpilih'";
}

$result_tampil = mysqli_query($koneksi, $query_tampil);

include 'header.php';
?>

<style>
    .form-group {
        text-align: center;
        font-size: 15px;
        margin-bottom: 20px; /* Jarak dari menu-item */
    }

    #selected_kategori {
        font-size: 15px;
        margin: 0 auto; /* Menengahkan formulir */
    }

    .menu-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
    }

    .menu-item {
        width: 230px;
        height: 250px;
        margin: 10px;
        text-align: center;
        border: 1px solid #ddd;
        padding: 10px;
        display: flex;
        flex-direction: column;
    }

    .menu-item img {
        width: 60%; 
        height: auto;
        margin-bottom: 5px;
    }

    .menu-details {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .menu-details h3,
    .menu-details p {
        margin: 0;
    }

    .menu-details h3 {
        font-size: 20px;
    }

    .menu-details p {
        font-size: 18px; 
    }

    .button-container {
        display: flex;
        justify-content: center;
        width: 100%;
    }

    .button-container button {
        width: 25%; 
        font-size: 16px;
        padding: 8px;
    }

    @media (max-width: 768px) {
        .menu-list {
            justify-content: space-around;
        }
    }
</style>

<title>Menu Admin</title>
    <body>
        <main class="main">
            <script>
                function changeCategory() {
                    document.getElementById("categoryForm").submit();
                }
            </script>

            <!-- Tambah Menu -->
            <button class="add-menu" onclick="window.location.href='tambah_menu.php'">Tambah Menu</button>

            <!-- Formulir Pemilihan Kategori -->
            <form id="categoryForm" method="get" onchange="changeCategory()">
                <div class="form-group">
                    <label for="selected_kategori">Pilih Kategori:</label>
                    <select name="kategori" id="selected_kategori" required>
                        <option value="paketan" <?php if($kategori_terpilih == 'PAKETAN') echo 'selected'; ?>>PAKETAN</option>
                        <option value="prasmanan" <?php if($kategori_terpilih == 'PRASMANAN') echo 'selected'; ?>>PRASMANAN</option>
                    </select>
                </div>
            </form>
            
            <!-- Menampilkan Menu -->
            <div class="menu-list">
                <?php
                while ($row = mysqli_fetch_assoc($result_tampil)) :
                ?>
                    <div class="menu-item">
                        <img src="uploads/<?php echo $row['foto_menu_path']; ?>" alt="<?php echo $row['nama_menu']; ?>">
                        <div class="menu-details">
                            <h3><?php echo $row['nama_menu']; ?></h3>
                            <p>Rp. <?php echo number_format($row['harga_menu'], 0, ',', '.'); ?></p>
                        </div>
                        <div class="button-container">
                            <button type="button" onclick="window.location.href='edit_menu.php?id=<?php echo $row['id_menu']; ?>';">
                            <i class="fas fa-pencil"></i>
                            </button>

                            <button class="sampah"type="button" onclick="if(confirm('Apakah Anda yakin?')) window.location.href='hapus_menu.php?id=<?php echo $row['id_menu']; ?>';">
                            <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </main>
    </body>
    
<?php include 'footer.php'; ?>