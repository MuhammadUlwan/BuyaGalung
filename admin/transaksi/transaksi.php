<?php
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: ../form/login.php");
    exit();
}
include "../../koneksi.php";
include 'header.php';
?>

<title>Transaksi</title>

<body>
    <main class="main">

        <table border="1" style="width: 75%; margin: 0 auto; border-collapse: collapse; border: 1px solid black;">
            <thead>
                <tr>
                    <th style="width: 2%;">#</th>
                    <th style="width: 10%;">Nama User</th>
                    <th style="width: 15%;">Bayar</th>
                    <th style="width: 10%;">Status</th>
                    <th style="width: 10%;">Metode Pembayaran</th>
                    <th style="width: 10%;">Tanggal Transaksi</th>
                    <th style="width: 10%;">Tanggal Pesan</th>
                    <th style="width: 10%;">Detail</th>
                    <th style="width: 10%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk mendapatkan data transaksi dan nama user
                $query = "SELECT transaksi.*, user.nama AS nama_user
                          FROM transaksi
                          INNER JOIN user ON transaksi.id_nama = user.id_nama";
                $result = mysqli_query($koneksi, $query);

                // Periksa apakah query berhasil dijalankan
                if (!$result) {
                    die("Query gagal: " . mysqli_error($koneksi));
                }

                // Tampilkan data transaksi
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td style='text-align: center;'><?php echo $row['id_transaksi']; ?></td>
                        <td style='text-align: center;'><?php echo $row['nama_user']; ?></td>
                        <td style='text-align: center;'>Rp. <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                        <td style='text-align: center;'><?php echo $row['status_transaksi']; ?></td>
                        <td style='text-align: center;'><?php echo $row['metode_pembayaran']; ?></td>
                        <td style='text-align: center;'><?php echo $row['tanggal_transaksi']; ?></td>
                        <td style='text-align: center;'><?php echo $row['tanggal_pesan']; ?></td>
                        <td style='text-align: center;'>
                            <a href='detail_transaksi.php?id_transaksi=<?php echo $row['id_transaksi']; ?>'>
                                <i class='bx bxs-detail' style='color: #11A100; font-size: 30px'></i>
                            </a>
                        </td>
                        <td style='text-align: center;'>
                            <?php
                            if ($row['status_transaksi'] == 'pending') {
                                ?>
                                <button class='verifikasi' onclick="verifikasi(<?php echo $row['id_transaksi']; ?>)">Verifikasi</button>
                                <button class='tolak' onclick="tolak(<?php echo $row['id_transaksi']; ?>)">Tolak</button>
                                <?php
                            } elseif ($row['status_transaksi'] == 'selesai') {
                                ?>
                                <button class='terima' onclick="terima(<?php echo $row['id_transaksi']; ?>)">Terima</button>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <script src="../js/aksi_transaksi.js"></script>
    </main>
</body>

<?php include 'footer.php'; ?>
