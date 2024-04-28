<?php
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: ../form/login.php");
} else {
    include('../koneksi.php');

    // Definisi variabel $kategori_terpilih
    $kategori_terpilih = isset($_GET['kategori']) ? strtoupper($_GET['kategori']) : 'PAKETAN';

    $query_tampil = "SELECT * FROM menu WHERE kategori_menu = '$kategori_terpilih'";
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

<title>Menu</title>
<body>
<main class="main">
    <!-- Formulir Pemilihan Kategori -->
    <form method="get" action="menu.php">
        <div class="form-group">
            <label for="selected_kategori">Pilih Kategori:</label>
            <select name="kategori" id="selected_kategori" onchange="this.form.submit()">
                <option value="PAKETAN" <?php if ($kategori_terpilih == 'PAKETAN') echo 'selected'; ?>>PAKETAN</option>
                <option value="PRASMANAN" <?php if ($kategori_terpilih == 'PRASMANAN') echo 'selected'; ?>>PRASMANAN</option>
            </select>
        </div>
    </form>

    <!-- Tampilkan item menu -->
    <div class="menu-list">
        <?php while ($row = mysqli_fetch_assoc($result_tampil)) : ?>
            <div class="menu-item">
                <img src="../admin/uploads/<?php echo $row['foto_menu_path']; ?>" alt="<?php echo $row['nama_menu']; ?>" class="menu-image">
                <div class="menu-details">
                    <h3><?php echo $row['nama_menu']; ?></h3>
                    <p>Rp <?php echo number_format($row['harga_menu'], 0, ',', '.'); ?></p>
                </div>
                <!-- Tombol "Tambah ke Keranjang" dan "Lihat Detail" dalam satu div -->
                <div class="button-container">
                    <button type="button" onclick="redirectToLogin('<?php echo $row['id_menu']; ?>')">
                        <i class="fas fa-shopping-cart"></i>
                    </button>

                    <button onclick="redirectToDetail('<?php echo $row['id_menu']; ?>')">
                        <i class="fas fa-info-circle"></i>
                    </button>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<script>
        function redirectToLogin(id_menu) {
        window.location.href = "login.php";
    }

    function redirectToDetail(id_menu) {
        window.location.href = "detail_menu.php?id=" + id_menu;
    }
</script>

<?php include 'footer.php' ?>
<?php } ?>
