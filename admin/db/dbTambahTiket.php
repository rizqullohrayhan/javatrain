<?php
require('../koneksi.php');

// ✅ SANITASI DAN VALIDASI SEMUA INPUT
$kereta = isset($_POST['kereta']) ? trim($_POST['kereta']) : '';
$asal = isset($_POST['asal']) ? trim($_POST['asal']) : '';
$tujuan = isset($_POST['tujuan']) ? trim($_POST['tujuan']) : '';
$tgl = isset($_POST['tgl']) ? trim($_POST['tgl']) : '';
$jam = isset($_POST['jam']) ? trim($_POST['jam']) : '';
$harga = isset($_POST['harga']) ? trim($_POST['harga']) : '';
$class = isset($_POST['class']) ? trim($_POST['class']) : '';

// ✅ VALIDASI INPUT TIDAK KOSONG
if (empty($kereta) || empty($asal) || empty($tujuan) || empty($tgl) || empty($jam) || empty($harga) || empty($class)) {
    echo "
    <script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Semua field harus diisi!');
    </script>
    ";
    exit;
}

// ✅ VALIDASI HARGA ADALAH ANGKA
if (!is_numeric($harga) || $harga <= 0) {
    echo "
    <script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Harga harus berupa angka positif!');
    </script>
    ";
    exit;
}

// ✅ VALIDASI CLASS HANYA NILAI TERTENTU
$allowed_classes = ['Eksekutif', 'Bisnis', 'Ekonomi'];
if (!in_array($class, $allowed_classes)) {
    echo "
    <script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Class tidak valid!');
    </script>
    ";
    exit;
}

// ✅ VALIDASI FORMAT TANGGAL
if (!DateTime::createFromFormat('Y-m-d', $tgl)) {
    echo "
    <script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Format tanggal tidak valid!');
    </script>
    ";
    exit;
}

// ✅ VALIDASI FORMAT JAM
if (!DateTime::createFromFormat('H:i', $jam)) {
    echo "
    <script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Format jam tidak valid!');
    </script>
    ";
    exit;
}

// ✅ MENGGUNAKAN PREPARED STATEMENT (AMAN DARI SQL INJECTION)
$stmt = $koneksi->prepare("INSERT INTO tiket (kode_kereta, dari, ke, tanggal, jam, class, harga) VALUES (?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Error preparing statement: " . $koneksi->error);
}

// Bind parameters: "ssssssi" = string, string, string, string, string, string, integer
$harga_int = (int)$harga;
$stmt->bind_param("ssssssi", $kereta, $asal, $tujuan, $tgl, $jam, $class, $harga_int);

if ($stmt->execute()) {
    echo "
    <script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Tiket berhasil ditambahkan');
    </script>
    ";
} else {
    echo "
    <script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Tiket gagal ditambahkan: " . addslashes($stmt->error) . "');
    </script>
    ";
}

$stmt->close();
?>