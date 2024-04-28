<?php
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location: ../form/login.php");
        exit();
    }
    include('../koneksi.php');

    // Query untuk mendapatkan data ulasan
    $query = "SELECT ulasan.id_ulasan, user.nama, menu.nama_menu, ulasan.rating, ulasan.komentar, ulasan.foto_menu_path, ulasan.tgl
    FROM ulasan
    JOIN user ON ulasan.id_nama = user.id_nama
    JOIN menu ON ulasan.id_menu = menu.id_menu";

    // Periksa apakah query berhasil dijalankan
    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        die("Query gagal: " . mysqli_error($koneksi));
    }

    include 'header.php';
?>

<style>
    .star {
        color: gold; /* Warna bintang penuh */
        font-size: 20px; /* Ukuran bintang */
    }

    /* CSS Lightbox */
    #lightbox {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 999;
        justify-content: center;
        align-items: center;
    }

    #lightbox img {
        max-width: 80%;
        max-height: 80%;
        border: 3px solid white;
        border-radius: 5px;
    }
</style>

<title>Ulasan Admin</title>
<body>
    <main class="main">
        <table border="1" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 20%;">Foto</th>
                    <th style="width: 10%;">Nama</th>
                    <th style="width: 10%;">Menu</th>
                    <th style="width: 10%;">Rating</th>
                    <th style="width: 35%;">Ulasan</th>
                    <th style="width: 10%;">Tanggal</th>
                    <!-- Tambahkan kolom lain jika diperlukan -->
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    // Tampilkan data ulasan
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td style='text-align: center;'>" . $no++ . "</td>";
                        echo "<td style='text-align: center;'><img src='uploads/{$row['foto_menu_path']}' alt='' style='width: 80px; height: 80px;' onclick='showImageInLightbox(\"uploads/{$row['foto_menu_path']}\")'></td>";
                        echo "<td style='text-align: center;'>{$row['nama']}</td>";
                        echo "<td style='text-align: center;'>{$row['nama_menu']}</td>";
                        echo "<td style='text-align: center;'>" . generateStars($row['rating']) . "</td>";
                        echo "<td>{$row['komentar']}</td>";
                        echo "<td style='text-align: center;'>{$row['tgl']}</td>";
                        echo "</tr>";
                    }

                    // Fungsi untuk menghasilkan bintang berdasarkan rating
                    function generateStars($rating)
                    {
                        $stars = "";
                        for ($i = 1; $i <= 5; $i++) {
                            $stars .= ($i <= $rating) ? "<span class='star'>&#9733;</span>" : "<span class='star'>&#9734;</span>";
                        }
                        return $stars;
                    }
                ?>
            </tbody>
        </table>
        <!-- Lightbox untuk memperbesar foto -->
        <div id="lightbox">
            <img id="lightbox-image" src="" alt="Lightbox Image">
        </div>
    </main>
    <script src="../node_modules/lightbox2/dist/js/lightbox.min.js"></script>
    <script>
        // Fungsi untuk menampilkan foto dalam Lightbox saat diklik
        function showImageInLightbox(imagePath) {
            var lightbox = document.getElementById('lightbox');
            var lightboxImage = document.getElementById('lightbox-image');
            
            // Ganti dengan kode yang mendukung zoom, contoh jika menggunakan lightbox2
            lightboxImage.src = imagePath;
            
            lightbox.style.display = 'flex';
        }

        // Fungsi untuk menyembunyikan Lightbox saat diklik di luar foto
        document.getElementById('lightbox').addEventListener('click', function (event) {
            if (event.target.id === 'lightbox') {
                document.getElementById('lightbox').style.display = 'none';
            }
        });
    </script>
</body>

<?php include 'footer.php'; ?>
