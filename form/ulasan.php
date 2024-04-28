<?php
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: login.php");
} else {
    include('../koneksi.php');

    // Definisi variabel $kategori_terpilih
    $kategori_terpilih = isset($_GET['kategori']) ? strtoupper($_GET['kategori']) : 'PAKETAN';

    $query_tampil = "SELECT menu.*, AVG(ulasan.rating) AS rating_rata FROM menu LEFT JOIN ulasan ON menu.id_menu = ulasan.id_menu WHERE menu.kategori_menu = '$kategori_terpilih' GROUP BY menu.id_menu ORDER BY menu.nama_menu";
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
        height: 300px; /* Menambahkan tinggi untuk memberikan ruang bagi tombol */
        margin: 10px;
        text-align: center;
        border: 1px solid #ddd;
        padding: 10px;
        display: flex;
        flex-direction: column;
        position: relative; /* Menambahkan posisi relatif */
    }

    .gambar-menu img {
        width: 60%;
        height: auto;
        margin-bottom: 5px;
    }

    .menu-details {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-grow: 1; /* Menggunakan fleksibilitas untuk memastikan menu-info dapat tumbuh */
    }

    .menu-info {
        margin-bottom: 10px;
    }

    .menu-details h2 {
        font-size: 20px;
    }

    .menu-details p {
        font-size: 16px;
    }

    .button-container {
        position: absolute;
        bottom: 10px; /* Menyesuaikan letak tombol ke bagian bawah menu-item */
        width: 100%;
    }

    .button-container button {
        width: 60%;
        font-size: 16px;
        padding: 8px;
    }

    @media (max-width: 768px) {
        .menu-list {
            justify-content: space-around;
        }
    }
</style>

<title>Ulasan</title>

<body>
    <main class="main">
        <!-- Formulir Pemilihan Kategori -->
        <form method="get" action="ulasan.php">
            <div class="form-group">
                <label for="selected_kategori">Pilih Kategori:</label>
                <select name="kategori" id="selected_kategori" onchange="this.form.submit()">
                    <option value="PAKETAN" <?php if ($kategori_terpilih == 'PAKETAN') echo 'selected'; ?>>PAKETAN</option>
                    <option value="PRASMANAN" <?php if ($kategori_terpilih == 'PRASMANAN') echo 'selected'; ?>>PRASMANAN</option>
                </select>
            </div>
        </form>
        <?php
        include '../user/page/functions.php';
        ?>
        <!-- Tampilkan item ulasan -->
        <div class="menu-list">
            <?php while ($row = mysqli_fetch_assoc($result_tampil)) : ?>
                <div class="menu-item">
                    <div class="gambar-menu">
                        <img src='../admin/uploads/<?php echo $row['foto_menu_path']; ?>' alt='<?php echo $row['nama_menu']; ?>'>
                    </div>
                    <div class="menu-details">
                        <div class="menu-info">
                            <h2><?php echo $row['nama_menu']; ?></h2>
                            <p>Rating: <span class='yellow-star'><?php echo generateStarRating($row['rating_rata']); ?></span></p>
                        </div>
                        <div class="button-container">
                            <?php
                            if (isset($_SESSION["login_user"])) {
                                echo "<button type='button' onclick='location.href=\"login.php\"' class='btn btn-ulas'>Beri Ulasan</button>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </main>
</body>

<?php include 'footer.php'; ?>
<?php } ?>