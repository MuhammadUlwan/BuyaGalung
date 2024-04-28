<?php
include '../../koneksi.php';
include '../function/header.php';

session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION["login_user"])) {
    header("location: ../form/login.php");
    exit();
}

$id_nama = isset($_SESSION['id_nama']) ? $_SESSION['id_nama'] : null;

if (isset($_POST['logout'])) {
    // Lakukan tindakan logout di sini
    session_destroy();
    header("Location: ../../index.php");
    exit();
}

// Ambil data user berdasarkan id_nama
$query_user = "SELECT * FROM user WHERE id_nama = '$id_nama'";
$result_user = mysqli_query($koneksi, $query_user);

if (!$result_user) {
    die("Query gagal: " . mysqli_error($koneksi));
}

$user_data = mysqli_fetch_assoc($result_user);
?>


<title>Account Setting</title>

<body>
    <main class="main">
        <div class="wrapper">
            <form action="edit.php" method="POST" id="editForm">
                <h1>AKUN ANDA</h1>

                <div class="input-box">
                    <input type="text" placeholder="Nama Anda" id="nama" name="nama" value="<?= $user_data['nama'] ?>" readonly>
                </div>

                <div class="input-box">
                    <input type="tel" placeholder="No Telephone" id="telepon" name="telepon" value="<?= $user_data['telepon'] ?>" readonly>
                </div>

                <div class="input-box">
                    <input type="text" placeholder="Email Anda" id="email" name="email" value="<?= $user_data['email'] ?>" readonly>
                </div>

                <div class="input-box">
                        <input type="password" placeholder="Password Anda" id="password" name="password" value="<?= $user_data['password'] ?>" readonly>
                        <span class="toggle-password" onclick="togglePasswordVisibility()">&#128065;</span>
                </div>

                <div class="container-menu">
                    <button type="submit" class="btn btn1" id="simpanBtn">
                        <span class="btn-text">Simpan</span>
                    </button>
                    <button type="submit" name="logout" class="btn btn1" id="keluarBtn">
                        <span class="btn-text">Keluar</span>
                    </button>
                </div>
            </form>
        </div>
    </main>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        setActiveLink();
        checkLogoutStatus(); // Menambahkan pemanggilan fungsi ini saat DOM dimuat
    });

    document.getElementById('keluarBtn').addEventListener('click', function(event) {
        event.preventDefault();
        // Menampilkan pesan
        alert('Anda telah keluar');
        // Menyimpan status logout di localStorage
        localStorage.setItem('logoutStatus', 'true');
        window.location.href = '../../index.php';
    });

    function togglePasswordVisibility() {
        var passwordField = document.getElementById('password');
        var toggleButton = document.querySelector('.toggle-password');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleButton.innerHTML = '&#128064;';
        } else {
            passwordField.type = 'password';
            toggleButton.innerHTML = '&#128065;';
        }
    }

    document.getElementById('editForm').addEventListener('click', function() {
        enableEditing();
    });

    function enableEditing() {
        var inputFields = document.querySelectorAll('form input:not([type="submit"]), form textarea');
        inputFields.forEach(function (field) {
            field.removeAttribute('readonly');
        });

        var simpanBtn = document.getElementById('simpanBtn');
        simpanBtn.style.display = 'inline-block';
        return false;
    }

    function checkLogoutStatus() {
        // Memeriksa status logout di localStorage
        var logoutStatus = localStorage.getItem('logoutStatus');

        if (logoutStatus === 'true') {
            // Lakukan logout jika status logout terdeteksi
            alert('Anda telah keluar (deteksi di tab lain)');
            // Hapus status logout dari localStorage
            localStorage.removeItem('logoutStatus');
            // Lakukan aksi logout sesuai kebutuhan, seperti mengarahkan ke halaman login
            // Misalnya: window.location.href = '../../index.php';
        }
    }
</script>
</body>

<?php include '../function/footer.php'; ?>
