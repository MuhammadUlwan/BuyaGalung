<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<style>
    .menu-item {
    margin-top: 30px;
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

button.sampah {
    background-color: red;
}

button:hover {
    background-color: #4A1260;
}
</style>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/page.css">
    <link rel="stylesheet" href="../node_modules/lightbox2/src/css/lightbox.css">
    <link rel="stylesheet" href="../node_modules/lightbox2/dist/css/lightbox.css">
    <link rel="stylesheet" href="../node_modules/lightbox2/dist/css/lightbox.min.css">
    <link rel="stylesheet" href="../node_modules/photoswipe/dist/photoswipe.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/medium-zoom/dist/medium-zoom.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400&display=swap">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="../node_modules/photoswipe/dist/photoswipe-lightbox.esm.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/medium-zoom/dist/medium-zoom.min.js"></script>
</head>
<body>
    <header class="header">
        <a href="" class="logo">
            <img src="../img/Logo.png" alt="Buya_Galung">
        </a>

        <nav class="navbar">
            <a href="home_admin.php" <?php if ($currentPage == 'home_admin.php') echo 'class="active"'; ?>>Beranda</a>
            <a href="menu_admin.php" <?php if ($currentPage == 'menu_admin.php' || $currentPage == 'edit_menu.php') echo 'class="active"'; ?>>Menu</a>
            <a href="ulasan_admin.php" <?php if ($currentPage == 'ulasan_admin.php') echo 'class="active"'; ?>>Ulasan</a>
            <a href="transaksi/transaksi.php" <?php if ($currentPage == 'transaksi/transaksi.php') echo 'class="active"'; ?>>Transaksi</a>
        </nav>

        <nav class="fitur">
            <a href="account_admin.php" class="logo-account <?php if ($currentPage == 'account_admin.php') echo 'active'; ?>"><i class='bx bxs-user-circle' ></i></a>
        </nav>
    </header>
</body>
</html>