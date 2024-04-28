<?php 
include('../koneksi.php');

$nama=$_POST["nama"];
$telepon=$_POST["telepon"];
$email=$_POST["email"];
$password=$_POST["password"];

$hasil = mysqli_query($koneksi, "INSERT INTO user (nama,telepon,email,password) VALUES ('$nama','$telepon','$email','$password')");

if ($hasil)
{
    echo "<script>
                alert('Anda Berhasil Registrasi !');
                document.location='login.php';
            </script>";
}
else
{
    echo "<script>
                alert ('Registrasi Anda Gagal !');
                document.location='register.php';
            </script>";
}

?>