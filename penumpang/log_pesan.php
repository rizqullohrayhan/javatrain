<?php
require('koneksi.php');
session_start();
date_default_timezone_set("Asia/Jakarta");

// ✅ VALIDASI SESSION DATA
if (!isset($_SESSION['kode']) || !isset($_SESSION['tiket']) || !isset($_SESSION['penumpang']) ||
    !isset($_SESSION['nama']) || !isset($_SESSION['nik']) || !isset($_SESSION['total'])) {
    echo "
    <script>
    let url = 'index.php';
    window.location.href = url;
    window.alert('Data session tidak lengkap! Silakan mulai dari awal.');
    </script>
    ";
    exit;
}

if (isset($_POST)) {
    // ✅ VALIDASI DAN SANITASI SEMUA SESSION DATA
    $kode_bayar = trim($_SESSION['kode']);
    $id_tiket = filter_var($_SESSION['tiket'], FILTER_VALIDATE_INT);
    $penumpang = filter_var($_SESSION['penumpang'], FILTER_VALIDATE_INT);
    $nama = trim($_SESSION['nama']);
    $nik = trim($_SESSION['nik']);
    $total = filter_var($_SESSION['total'], FILTER_VALIDATE_INT);
    
    // Validasi semua data
    if ($id_tiket === false || $penumpang === false || $total === false) {
        echo "
        <script>
        let url = 'index.php';
        window.location.href = url;
        window.alert('Data tidak valid!');
        </script>
        ";
        exit;
    }
    
    if (empty($nama) || strlen($nama) > 100) {
        echo "
        <script>
        let url = 'index.php';
        window.location.href = url;
        window.alert('Data nama tidak valid!');
        </script>
        ";
        exit;
    }
    
    if (!preg_match('/^\d{16}$/', $nik)) {
        echo "
        <script>
        let url = 'index.php';
        window.location.href = url;
        window.alert('Format NIK tidak valid!');
        </script>
        ";
        exit;
    }
    
    // Hitung waktu expired
    $expired1 = time() + 600;
    $expired = date("H:i:s", $expired1);
    $jam = date("Y-m-d H:i:s");
    
    // ✅ MENGGUNAKAN PREPARED STATEMENT (AMAN DARI SQL INJECTION)
    $stmt = $koneksi->prepare("INSERT INTO log_pesan 
        (kode_bayar, id_tiket, penumpang, nama, nik, harga, expired, jam_booking) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Error preparing statement: " . $koneksi->error);
    }
    
    // Bind parameters: "siiisiss" = string, int, int, string, string, int, string, string
    $stmt->bind_param("siiisiss", $kode_bayar, $id_tiket, $penumpang, $nama, $nik, $total, $expired, $jam);
    
    if ($stmt->execute()) {
        session_destroy();
        echo "
        <script>
        let url = 'index.php';
        window.location.href = url;
        window.alert('Tiket Berhasil diBooking! Harap bayar dalam waktu 10 menit setelah memboking!!!');
        </script>
        ";
    } else {
        echo "
        <script>
        let url = 'index.php';
        window.location.href = url;
        window.alert('Gagal membooking tiket: " . addslashes($stmt->error) . "');
        </script>
        ";
    }
    
    $stmt->close();
} else {
    echo "
    <script>
    let url = 'index.php';
    window.location.href = url;
    window.alert('Gagal membooking tiket! Harap isi semua data dengan benar!');
    </script>
    ";
}
?>