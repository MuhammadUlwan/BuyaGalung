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
    <link rel="stylesheet" href="css/page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400&display=swap">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header class="header">
        <a href="form/tentang.php" class="logo">
            <img src="img/Logo.png" alt="Buya_Galung">
        </a>

        <nav class="navbar">
    <a href="index.php" <?php if ($currentPage == 'index.php') echo 'class="active"'; ?>>Beranda</a>
    <a href="form/menu.php" <?php if ($currentPage == 'menu.php') echo 'class="active"'; ?>>Menu</a>
    <a href="form/ulasan.php" <?php if ($currentPage == 'ulasan.php') echo 'class="active"'; ?>>Ulasan</a>
    <a href="form/tentang.php" <?php if ($currentPage == 'tentang.php') echo 'class="active"'; ?>>Tentang</a>
</nav>

        <nav class="fitur">
            <div class="left-icon">
                <a href="form/login.php"><i class='bx bx-log-in'></i>
                    <span>Masuk</span>
                </a>
                <a href="form/daftar.php"><i class='bx bx-user-plus'></i>
                    <span>Daftar</span>
                </a>
            </div>
            <a href="form/login.php"><i class='bx bxs-cart' ></i></a>
        </nav>
    </header>
</body>
</html>
