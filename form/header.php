<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<style>
/* Ulasan */
.menu-item {
        width: auto; /* Sesuaikan lebar sesuai kebutuhan Anda */
        height: 150px; /* Sesuaikan tinggi sesuai kebutuhan Anda */
        margin: 20px; /* Sesuaikan margin sesuai kebutuhan Anda */
        padding: 15px;
        border: 1px solid #ddd; /* Atur border sesuai kebutuhan Anda */
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Atur shadow sesuai kebutuhan Anda */
        text-align: center;
    }

.beri-ulasan-btn {
    margin-left: 10px;
    display: inline-block;
    padding: 8px 12px;
    background-color: #4caf50;
    color: white;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
/* Ulasan Bintang */
.yellow-star {
    color: gold;
}

.form-group {
    margin-bottom: 20px;
}

/* Tombol kirim ulasan */
input[type="submit"] {
    background-color: #11A100;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #4A1260;
}

/* Gaya untuk tombol Checkout */
.cek {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-top: 20px;
    background-color: #fff; /* Tambahkan warna putih pada latar belakang */
    padding: 10px; /* Tambahkan ruang padding agar rapih */
    border-radius: 5px; /* Tambahkan sudut melengkung pada border */
    width: 150px; /* Sesuaikan ukuran form sesuai kebutuhan */
    margin-left: 1125px;
}

.cek button[name="checkout"] {
    padding: 10px 20px;
    font-size: 18px;
    background-color: #11A100;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.cek button[name="checkout"]:hover {
    background-color: #4A1260;
}

.total-harga-container {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.pembayaran-container {
    text-align: center;
}

.button-container {
    display: flex;
    justify-content: center;
    gap: 10px;
}

button {
    background-color: #3498db;
    color: #fff;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #4A1260;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/page.css">
    <link rel="stylesheet" href="../admin/admin.css">   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400&display=swap">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header class="header">
        <a href="tentang.php" class="logo">
            <img src="../img/Logo.png" alt="Buya_Galung">
        </a>

        <nav class="navbar">
    <a href="../index.php" <?php if ($currentPage == 'index.php') echo 'class="active"'; ?>>Beranda</a>
    <a href="menu.php" <?php if ($currentPage == 'menu.php' || $currentPage == 'detail_menu.php') echo 'class="active"'; ?>>Menu</a>
    <a href="ulasan.php" <?php if ($currentPage == 'ulasan.php') echo 'class="active"'; ?>>Ulasan</a>
    <a href="tentang.php" <?php if ($currentPage == 'tentang.php') echo 'class="active"'; ?>>Tentang</a>
</nav>

        <nav class="fitur">
            <div class="left-icon">
                <a href="login.php"><i class='bx bx-log-in'></i>
                    <span>Masuk</span>
                </a>
                <a href="daftar.php"><i class='bx bx-user-plus'></i>
                    <span>Daftar</span>
                </a>
            </div>
            <a href="login.php"><i class='bx bxs-cart' ></i></a>
        </nav>
    </header>
</body>
</html>