function verifikasi(id) {
    // Konfirmasi sebelum mengubah tombol
    if (confirm('Apakah Anda yakin ingin verifikasi pesanan ini?')) {
        // Sembunyikan tombol verifikasi
        document.querySelector('.verifikasi').style.display = 'none';

        // Tampilkan tombol terima
        document.querySelector('.terima').style.display = 'block';

        // Contoh aksi setelah verifikasi, bisa diubah sesuai kebutuhan
        alert('Pesanan berhasil diverifikasi for ID ' + id);
    }
}

function tolak(id) {
    // Your tolak logic here
    if (confirm('Anda yakin ingin menolak pesanan ini?')) {
        window.location.href = 'tolak_pesanan.php?id_transaksi=' + id;
    }
}

function terima(id) {
    // Your terima logic here
    alert('Terima for ID ' + id);
}
