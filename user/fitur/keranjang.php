<?php
session_start();

if (!isset($_SESSION["login_user"])) {
    header("location: ../form/login.php");
    exit();
}

include('../../koneksi.php');

// Set id_nama jika belum di-set
if (!isset($_SESSION['id_nama'])) {
    // Redirect ke halaman login jika id_nama belum di-set
    header("location: ../form/login.php");
    exit();
}

// Proses tambah ke keranjang
if (isset($_GET['tambah_ke_keranjang'])) {
    $id_menu = $_GET['id_menu'];
    $quantity = 1;
    $total_harga = $_GET['harga_menu'] * $quantity;

    // Cek apakah barang sudah ada di keranjang
    $query_cek = "SELECT * FROM keranjang WHERE id_nama = ? AND id_menu = ?";
    $stmt_cek = mysqli_prepare($koneksi, $query_cek);
    mysqli_stmt_bind_param($stmt_cek, "ii", $_SESSION['id_nama'], $id_menu);
    mysqli_stmt_execute($stmt_cek);
    $result_cek = mysqli_stmt_get_result($stmt_cek);

    if (mysqli_num_rows($result_cek) > 0) {
        // Jika sudah ada, update quantity dan total harga
        $row_cek = mysqli_fetch_assoc($result_cek);
        $new_quantity = $row_cek['quantity'] + 1;
        $new_total_harga = $_GET['harga_menu'] * $new_quantity;

        $query_update = "UPDATE keranjang SET quantity = $new_quantity, total_harga = $new_total_harga
        WHERE id_nama = " . $_SESSION['id_nama'] . " AND id_menu = $id_menu";
        mysqli_query($koneksi, $query_update);

    } else {
        $query_tambah = "INSERT INTO keranjang (id_nama, id_menu, quantity, total_harga) VALUES (?, ?, ?, ?)";
        $stmt_tambah = mysqli_prepare($koneksi, $query_tambah);
        mysqli_stmt_bind_param($stmt_tambah, "iiid", $_SESSION['id_nama'], $id_menu, $quantity, $total_harga);
        mysqli_stmt_execute($stmt_tambah);        
    }

    // Redirect back to menu.php with selected category
    // header("location: ../page/menu.php?kategori=" . $kategori_terpilih);
    // exit();
}

// Proses update quantity
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_quantity'])) {
    $id_menu = $_POST['update_quantity'];
    $new_quantity = $_POST['new_quantity'];

    // Validasi dan perbarui jumlah di database
    if ($new_quantity > 0) {
        // Ambil harga_menu dari tabel menu
        $query_get_harga = "SELECT harga_menu FROM menu WHERE id_menu = $id_menu";
        $result_get_harga = mysqli_query($koneksi, $query_get_harga);
        $row_get_harga = mysqli_fetch_assoc($result_get_harga);
        $harga_menu = $row_get_harga['harga_menu'];

        $new_total_harga = $harga_menu * $new_quantity;

        $query_update_quantity = "UPDATE keranjang SET quantity = $new_quantity, total_harga = $new_total_harga
                                  WHERE id_nama = " . $_SESSION['id_nama'] . " AND id_menu = $id_menu";
        mysqli_query($koneksi, $query_update_quantity);

        // Redirect agar saat refresh halaman tidak terjadi resubmission form
        header("Location: keranjang.php");
        exit();
    }
}

// Proses delete selected items dari keranjang
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_item'])) {
    $id_menu = $_POST['delete_item'];

    $query_delete_item = "DELETE FROM keranjang WHERE id_nama = ? AND id_menu = ?";
    $stmt_delete_item = mysqli_prepare($koneksi, $query_delete_item);

    if ($stmt_delete_item) {
        // Bind parameter
        mysqli_stmt_bind_param($stmt_delete_item, "ii", $_SESSION['id_nama'], $id_menu);

        // Execute statement
        mysqli_stmt_execute($stmt_delete_item);

        // Tutup statement
        mysqli_stmt_close($stmt_delete_item);
    }

    // Redirect agar saat refresh halaman tidak terjadi resubmission form
    header("Location: keranjang.php");
    exit();
}

// Ambil data keranjang
$query_keranjang = "SELECT keranjang.*, menu.nama_menu, menu.harga_menu
                    FROM keranjang
                    INNER JOIN menu ON keranjang.id_menu = menu.id_menu
                    WHERE id_nama = " . $_SESSION['id_nama'];
$result_keranjang = mysqli_query($koneksi, $query_keranjang);

include '../function/header.php';
?>
<style>
    .quantity-form {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .edit-icon {
        margin-right: 5px;
    }
    
</style>
<title>Keranjang</title>
<body>
<main class="main">

    <table border="1" style="width: 75%; margin: 0 auto; border-collapse: collapse; border: 1px solid black;">
        <thead>
        <tr>
            <th style="width: 5%;">#</th>
            <th style="width: 20%;">Nama Menu</th>
            <th style="width: 15%;">Harga</th>
            <th style="width: 15%;">Quantity</th>
            <th style="width: 15%;">Total Harga</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1; // Tentukan nilai awal untuk $no
        while ($row_keranjang = mysqli_fetch_assoc($result_keranjang)) :
            ?>
            <tr>
                <td style='text-align: center;'><?php echo $no++; ?></td>
                <td><?php echo $row_keranjang['nama_menu']; ?></td>
                <td style='text-align: center;'>Rp. <?php echo number_format($row_keranjang['harga_menu'], 0, ',', '.'); ?></td>
                <td style='text-align: center;'>
                    <form method="post" action="">
                        <input type="number" name="new_quantity" value="<?php echo $row_keranjang['quantity']; ?>" min="1">
                        <button type="submit" name="update_quantity" value="<?php echo $row_keranjang['id_menu']; ?>" class='bx bxs-pencil edit-icon'></button>
                        <button type="submit" name="delete_item" value="<?php echo $row_keranjang['id_menu']; ?>" class='bx bx-trash delete-icon'></button>
                    </form>
                </td>
                <td style='text-align: center;'>Rp. <?php echo number_format($row_keranjang['total_harga'], 0, ',', '.'); ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <form method="post" action="checkout.php" class="cek">
        <button type="submit" name="checkout">Checkout</button>
    </form>
</main>

<!-- Pastikan Anda menyertakan jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</body>

<?php include '../function/footer.php'; ?>
