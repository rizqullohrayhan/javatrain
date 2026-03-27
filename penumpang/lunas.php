<?php
require('koneksi.php');

// ✅ VALIDASI DAN SANITASI INPUT
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$nik = isset($_GET['nik']) ? trim($_GET['nik']) : '';

// ✅ VALIDASI ID
if ($id <= 0) {
    die("ID tidak valid!");
}

// ✅ VALIDASI NIK
if (empty($nik)) {
    die("NIK tidak valid!");
}

if (!preg_match('/^\d{16}$/', $nik)) {
    die("Format NIK tidak valid!");
}

// ✅ CEK STATUS MENGGUNAKAN PREPARED STATEMENT
$stmt_cek = $koneksi->prepare("SELECT status FROM log_pesan WHERE id = ?");
$stmt_cek->bind_param("i", $id);
$stmt_cek->execute();
$result = $stmt_cek->get_result();
$c = $result->fetch_assoc();
$stmt_cek->close();

if (!$c) {
    die("Data pembayaran tidak ditemukan!");
}

// ✅ UPDATE STATUS MENGGUNAKAN PREPARED STATEMENT
if($c['status'] != "Expired") {
    $stmt = $koneksi->prepare("UPDATE log_pesan SET status = 'Lunas' WHERE id = ?");
    $stmt->bind_param("i", $id);
    $lunas = $stmt->execute();
    $stmt->close();
} else {
    $lunas = false;
}

if ($lunas) {
    echo "
    <script>
        let url= 'cekPesanan.php?nik=" . urlencode($nik) . "';
        window.location.href = url;
        window.alert('Pembayaran berhasil');
    </script>
    ";
} else {
    echo "
    <script>
        let url= 'cekPesanan.php?nik=" . urlencode($nik) . "';
        window.location.href = url;
        window.alert('Pembayaran gagal');
    </script>
    ";
}
?>
