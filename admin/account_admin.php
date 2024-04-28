<?php
    include('../koneksi.php');
// Pastikan user telah login
session_start();
if (!isset($_SESSION["login_user"])) {
    header("location: ../form/login.php");
    exit();
}

$id_nama = isset($_SESSION['id_nama']) ? $_SESSION['id_nama'] : null;

// Ambil data user berdasarkan id_nama
$query_user = "SELECT * FROM user WHERE id_nama = '$id_nama'";
$result_user = mysqli_query($koneksi, $query_user);

if (!$result_user) {
    die("Query gagal: " . mysqli_error($koneksi));
}

$user_data = mysqli_fetch_assoc($result_user);
    include 'header.php';
?>

<title>Account Admin</title>
<body>
    <main class="main">
        <div class="wrapper">
            <form action="edit_acc.php" method="POST" id="editForm">
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
                    <a href="../index.php" class="btn btn1" id="keluarBtn">
                        <span class="btn-text">Keluar</span>
                    </a>
                </div>
            </form>
        </div>
    </main>

    <script>
        function setActiveLink() {
            var path = window.location.pathname;
            var accountLink = $(".fitur a[href*='account_admin.php']");
            var keranjangLink = $(".fitur a[href*='keranjang.php']");

            if (path.includes("account_admin.php")) {
                accountLink.addClass("active");
            } else if (path.includes("keranjang.php")) {
                keranjangLink.addClass("active");
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            setActiveLink();
        });
        document.getElementById('keluarBtn').addEventListener('click', function(event) {
            event.preventDefault();
            // Menampilkan pesan
            alert('Anda telah keluar');
            window.location.href = this.href;
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
        }
    </script>
</body>

<?php include 'footer.php'; ?>