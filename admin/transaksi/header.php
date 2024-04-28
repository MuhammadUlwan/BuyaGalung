<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<style>
    .form-group {
    margin-bottom: 20px;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/page.css">
    <link rel="stylesheet" href="../admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400&display=swap">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header class="header">
        <a href="" class="logo">
            <img src="../../img/Logo.png" alt="Buya_Galung">
        </a>

        <nav class="navbar">
            <a href="../home_admin.php" <?php if ($currentPage == '../home_admin.php') echo 'class="active"'; ?>>Beranda</a>
            <a href="../menu_admin.php" <?php if ($currentPage == '../menu_admin.php') echo 'class="active"'; ?>>Menu</a>
            <a href="../ulasan_admin.php" <?php if ($currentPage == '../ulasan_admin.php') echo 'class="active"'; ?>>Ulasan</a>
            <a href="transaksi.php" <?php if ($currentPage == 'transaksi.php') echo 'class="active"'; ?>>Transaksi</a>
        </nav>

        <nav class="fitur">
            <a href="../account_admin.php"><i class='bx bxs-user-circle' ></i></a>
        </nav>
    </header>
</body>
</html>