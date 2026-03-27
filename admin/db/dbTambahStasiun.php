<?php
require('../koneksi.php');

// ✅ VALIDASI DAN SANITASI INPUT
$nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';

// ✅ VALIDASI INPUT TIDAK KOSONG
if (empty($nama)) {
    echo "<script>
        let url = '../stasiun.php';
        window.location.href = url;
        window.alert('Nama stasiun harus diisi!');
    </script>";
    exit;
}

// ✅ VALIDASI PANJANG INPUT
if (strlen($nama) > 100) {
    echo "<script>
        let url = '../stasiun.php';
        window.location.href = url;
        window.alert('Nama stasiun terlalu panjang!');
    </script>";
    exit;
}

// ✅ MENGGUNAKAN PREPARED STATEMENT (AMAN DARI SQL INJECTION)
$stmt = $koneksi->prepare("INSERT INTO stasiun (nama_stasiun) VALUES (?)");

if (!$stmt) {
    die("Error preparing statement: " . $koneksi->error);
}

$stmt->bind_param("s", $nama);

if ($stmt->execute()) {
    echo "<script>
        let url = '../stasiun.php';
        window.location.href = url;
        window.alert('Stasiun berhasil ditambahkan');
    </script>";
} else {
    echo "<script>
        let url = '../stasiun.php';
        window.location.href = url;
        window.alert('Stasiun gagal ditambahkan: " . addslashes($stmt->error) . "');
    </script>";
}

$stmt->close();
?>