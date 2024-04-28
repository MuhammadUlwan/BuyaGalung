<?php
    session_start();
    if(!isset($_SESSION["login_user"])){
        header("location: ../form/login.php");
    }else{

        include '../function/header.php';
?>

<title>Tentang</title>
<body>
    <main class="main">
        <div class="wlcm">
            <h7 class="w1">Tentang Kami</h7>
            <h1 class="w2">BUYA GALUNG CATERING</h1>
        </div>
        <br>
        <br>
        <div class="BG">
            <p align="center"><img src="../../img/Foto1.png" align="center" hspace="auto" width="auto" height="auto" > 
            <div class="about">
            <p>Buya Galung Catering merupakan bisnis catering yang bertempat di Palimanan, Cirebon, 
                Buya Galung Catering ini menyediakan berbagai menu untuk catering seperti acara hajatan, pernikahan,dan lain lain, 
                layanan catering ini sudah termasuk dengan pengiriman.</p>
            <br>
            <p>Bisnis ini telah menerima banyak rating dengan rata-rata bintang 5,
                Buya Galung Catering sudah bersetifikasi HALAL MUI. 
                Dan untuk pemesanan catering dilakukan minimal 2 hari sebelum acara nya dimulai</p>
            <br>
            <p>Buya Galung Catering menyediakan berbagai macam catering pilihan seperti :</p>
            <br>
            <p>· Menu Nasi Kuning</p>
            <p>· Daging Rendang</p>
            <p>· Ayam Bakar</p>
            <p>· Daging Gepuk</p>
            <p>· Ayam Bistik</p>
            <p>· Daging Bistik</p>
            </div>
            <div class="foto">
                <div class="serti">
                    <h3 class="kt1">SERTIFIKAT KAMI</h3>
                    <img src="../../img/serti.png" alt="foto1" class="ft1">
                </div>
                <div class="map">
                    <h3 class="kt2">LOKASI KAMI</h3>
                    <a href="https://maps.app.goo.gl/Ls5e6st5i4KftwFx6" target="_blank">
                        <img src="../../img/map.png" alt="foto2" class="ft2">
                    </a>
                </div>
            </div>            
        </div>
    </main>
</body>

<?php include '../function/footer.php'; ?>
<?php } ?>