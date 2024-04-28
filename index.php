<?php
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location: form/login.php");
        exit();
    }
    include 'header.php';
?>
<title>Buya Galung Catering</title>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<style>
    .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 90%;
        max-width: 8000px; /* Sesuaikan dengan lebar maksimum yang diinginkan */
        height: 50vh;
        background-color: rgba(169, 169, 169, 0.7); /* Warna abu-abu transparan */
        padding: 20px; /* Sesuaikan dengan kebutuhan */
        margin-top: 25px;
        margin-left: 80px;
    }

    .welcome-container {
        width: 40%;
        padding-left: 20px;
    }

    .w1 {
        text-align: left;
        font-size: 20px;
        margin-top: 20px;
    }

    .w2 {
        text-align: left;
        font-size: 35px;
        margin-top: 20px;
    }

    .w3 {
        text-align: left;
        margin-top: 20px;
    }

    .slideshow-container {
        width: 50%;
        position: relative;
        overflow: hidden;
    }

    .welcome-container,
    .slideshow-container {
        width: 50%; /* Ubah menjadi 45% agar lebih sesuai */
        margin-left: 200px;
    }

    .slides {
        display: flex;
        align-items: center;
        transition: transform 0.5s ease-in-out;
    }

    .slide {
        min-width: 100%;
        overflow: hidden;
    }

    .slide img {
        max-width: 75%;
        height: auto;
    }
    
    .second-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 50vh;
    background-image: url('admin/uploads/bg1.jpg');
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    padding: 20px;
    margin-top: 25px;
    }

    .info-container {
        display: flex;
        gap: 200px;
        margin-left: 100px;
        margin-right: 100px;
        justify-content: space-between; /* Menyusun elemen secara merata di sepanjang container */
    }

    .info-item {
        text-align: center;
        color: white;
        width: 25%; /* Menyesuaikan lebar masing-masing info-item */
    }

    .info-container img {
        width: 75px; /* Sesuaikan dengan ukuran yang diinginkan */
        height: 75px; /* Sesuaikan dengan ukuran yang diinginkan */
        filter: invert(86%) sepia(85%) saturate(284%) hue-rotate(335deg) brightness(93%) contrast(87%);
    }
    
    .info-item p {
        font-size: 15px; /* Sesuaikan dengan ukuran yang diinginkan */
        margin-top: 25px; /* Menambah jarak antara gambar dan teks */
    }
</style>

<body>
<main class="main">
        <div class="container">
        <div class="welcome-container">
            <h3 class="w1">Selamat Datang Di Website</h3>
            <h1 class="w2">Buya Galung Catering</h1>
            <h4 class="w3">Buya Galung Catering siap menyediakan nasi kotak berbagai macam menu masakan dengan harga murah meriah dan higienis, yang pastinya dapat disesuaikan dengan budget.</h4>
            <h4 class="w3">Soal Rasa Boleh Dicoba.</h4>
        </div>
        <div class="slideshow-container">
            <div class="slides">
                <div class="slide">
                    <img src="admin/uploads/1.jpeg" alt="Menu 1">
                </div>
                <div class="slide">
                    <img src="admin/uploads/2.jpeg" alt="Menu 2">
                </div>
                <div class="slide">
                    <img src="admin/uploads/3.jpeg" alt="Menu 3">
                </div>
                <div class="slide">
                    <img src="admin/uploads/4.jpeg" alt="Menu 4">
                </div>
                <div class="slide">
                    <img src="admin/uploads/5.jpeg" alt="Menu 5">
                </div>
                <div class="slide">
                    <img src="admin/uploads/6.jpeg" alt="Menu 6">
                </div>
            </div>
        </div>
        </div>

        <div class="second-container">
            <div class="info-container">
                <div class="info-item">
                    <img src="admin/uploads/kal.png" alt="Calendar" width="25" height="25">
                    <p>Pesanan sebaiknya dilakukan 2 hari sebelum acara.</p>
                </div>
                <div class="info-item">
                    <img src="admin/uploads/food.png" alt="Food" width="25" height="25">
                    <p>Berbagai macam menu masakan dengan harga murah dan higienis.</p>
                </div>
                <div class="info-item">
                    <img src="admin/uploads/order.png" alt="Order" width="25" height="25">
                    <p>Batas pemesanan minimum 20 pesanan.</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        // JavaScript untuk membuat slideshow otomatis
        const slides = document.querySelector('.slides');
        const slideItems = document.querySelectorAll('.slide');
        let currentIndex = 0;

        function showSlide(index) {
            const newPosition = -index * 100 + '%';
            slides.style.transform = 'translateX(' + newPosition + ')';
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slideItems.length;
            showSlide(currentIndex);
        }

        setInterval(nextSlide, 3000); 
    </script>
</body>
<?php include 'footer.php'; ?>