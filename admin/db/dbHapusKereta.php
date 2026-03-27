<?php
require('../koneksi.php');

// ✅ VALIDASI DAN SANITASI INPUT
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// ✅ VALIDASI ID
if ($id <= 0) {
    echo "<script>
        let url = '../kereta.php';
        window.location.href = url;
        window.alert('ID tidak valid!');
    </script>";
    exit;
}

// ✅ MENGGUNAKAN PREPARED STATEMENT (AMAN DARI SQL INJECTION)
$stmt = $koneksi->prepare("DELETE FROM kereta WHERE id = ?");

if (!$stmt) {
    die("Error preparing statement: " . $koneksi->error);
}

$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>
        let url = '../kereta.php';
        window.location.href = url;
    </script>";
} else {
    echo "<script>
        let url = '../kereta.php';
        window.location.href = url;
        window.alert('Kereta gagal dihapus: " . addslashes($stmt->error) . "');
    </script>";
}

$stmt->close();
