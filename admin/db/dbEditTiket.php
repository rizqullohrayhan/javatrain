<?php
require('../koneksi.php');

// ✅ VALIDASI DAN SANITASI INPUT
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$kereta = isset($_POST['kereta']) ? trim($_POST['kereta']) : '';
$asal = isset($_POST['asal']) ? trim($_POST['asal']) : '';
$tujuan = isset($_POST['tujuan']) ? trim($_POST['tujuan']) : '';
$tgl = isset($_POST['tgl']) ? trim($_POST['tgl']) : '';
$jam = isset($_POST['jam']) ? trim($_POST['jam']) : '';
$harga = isset($_POST['harga']) ? trim($_POST['harga']) : '';
$class = isset($_POST['class']) ? trim($_POST['class']) : '';

// ✅ VALIDASI ID
if ($id <= 0) {
    echo "<script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('ID tidak valid!');
    </script>";
    exit;
}

// ✅ VALIDASI INPUT TIDAK KOSONG
if (empty($kereta) || empty($asal) || empty($tujuan) || empty($tgl) || empty($jam) || empty($harga) || empty($class)) {
    echo "<script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Semua field harus diisi!');
    </script>";
    exit;
}

// ✅ VALIDASI HARGA ADALAH ANGKA
if (!is_numeric($harga) || $harga <= 0) {
    echo "<script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Harga harus berupa angka positif!');
    </script>";
    exit;
}

// ✅ VALIDASI CLASS
$allowed_classes = ['Eksekutif', 'Bisnis', 'Ekonomi'];
if (!in_array($class, $allowed_classes)) {
    echo "<script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Class tidak valid!');
    </script>";
    exit;
}

// ✅ VALIDASI FORMAT TANGGAL
if (!DateTime::createFromFormat('Y-m-d', $tgl)) {
    echo "<script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Format tanggal tidak valid!');
    </script>";
    exit;
}

// ✅ VALIDASI FORMAT JAM
if (!DateTime::createFromFormat('H:i', $jam)) {
    echo "<script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Format jam tidak valid!');
    </script>";
    exit;
}

// ✅ MENGGUNAKAN PREPARED STATEMENT (AMAN DARI SQL INJECTION)
$stmt = $koneksi->prepare("UPDATE tiket SET kode_kereta = ?, dari = ?, ke = ?, tanggal = ?, jam = ?, class = ?, harga = ? WHERE id = ?");

if (!$stmt) {
    die("Error preparing statement: " . $koneksi->error);
}

$harga_int = (int)$harga;
$stmt->bind_param("ssssssii", $kereta, $asal, $tujuan, $tgl, $jam, $class, $harga_int, $id);

if ($stmt->execute()) {
    echo "<script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Tiket berhasil diedit');
    </script>";
} else {
    echo "<script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Tiket gagal diedit: " . addslashes($stmt->error) . "');
    </script>";
}

$stmt->close();
?>