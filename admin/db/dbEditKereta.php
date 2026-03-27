<?php
require('../koneksi.php');

// ✅ VALIDASI DAN SANITASI INPUT
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
$kode = isset($_POST['kode']) ? trim($_POST['kode']) : '';

// ✅ VALIDASI ID
if ($id <= 0) {
    echo "
    <script>
        let url = '../kereta.php';
        window.location.href = url;
        window.alert('ID tidak valid!');
    </script>
    ";
    exit;
}

// ✅ VALIDASI INPUT TIDAK KOSONG
if (empty($nama) || empty($kode)) {
    echo "
    <script>
        let url = '../kereta.php';
        window.location.href = url;
        window.alert('Semua field harus diisi!');
    </script>
    ";
    exit;
}

// ✅ VALIDASI PANJANG INPUT
if (strlen($nama) > 100 || strlen($kode) > 20) {
    echo "
    <script>
        let url = '../kereta.php';
        window.location.href = url;
        window.alert('Input terlalu panjang!');
    </script>
    ";
    exit;
}

// ✅ AMBIL DATA KERETA LAMA DENGAN PREPARED STATEMENT
$stmt_check = $koneksi->prepare("SELECT img_kereta FROM kereta WHERE id = ?");
$stmt_check->bind_param("i", $id);
$stmt_check->execute();
$result = $stmt_check->get_result();
$data = $result->fetch_assoc();
$stmt_check->close();

if (!$data) {
    echo "
    <script>
        let url = '../kereta.php';
        window.location.href = url;
        window.alert('Kereta tidak ditemukan!');
    </script>
    ";
    exit;
}

$gambar = $data['img_kereta'];

// ✅ VALIDASI FILE UPLOAD (JIKA ADA)
if (isset($_FILES['gambar']) && $_FILES['gambar']['size'] > 0) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $max_size = 5242880; // 5MB
    
    // Cek ukuran file
    if ($_FILES['gambar']['size'] > $max_size) {
        echo "
        <script>
            let url = '../kereta.php';
            window.location.href = url;
            window.alert('Ukuran file tidak boleh lebih dari 5MB!');
        </script>
        ";
        exit;
    }
    
    // Cek MIME type menggunakan finfo
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $_FILES['gambar']['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($mime_type, $allowed_types)) {
        echo "
        <script>
            let url = '../kereta.php';
            window.location.href = url;
            window.alert('Format file tidak diizinkan! Hanya JPG, PNG, GIF yang diperbolehkan!');
        </script>
        ";
        exit;
    }
    
    // Hapus file lama
    if ($gambar && file_exists('../img/kereta/' . $gambar)) {
        unlink('../img/kereta/' . $gambar);
    }
    
    // Generate nama file unik
    $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
    $gambar = 'kereta_' . time() . '_' . bin2hex(random_bytes(8)) . '.' . strtolower($ext);
    $uploadpath = '../img/kereta/' . $gambar;
    
    // Pindahkan file
    if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadpath)) {
        echo "
        <script>
            let url = '../kereta.php';
            window.location.href = url;
            window.alert('Gagal upload file!');
        </script>
        ";
        exit;
    }
}

// ✅ MENGGUNAKAN PREPARED STATEMENT (AMAN DARI SQL INJECTION)
$stmt = $koneksi->prepare("UPDATE kereta SET nama_kereta = ?, kode_kereta = ?, img_kereta = ? WHERE id = ?");

if (!$stmt) {
    die("Error preparing statement: " . $koneksi->error);
}

$stmt->bind_param("sssi", $nama, $kode, $gambar, $id);

if ($stmt->execute()) {
    echo "
    <script>
        let url = '../kereta.php';
        window.location.href = url;
        window.alert('Kereta Berhasil di Edit');
    </script>
    ";
} else {
    // Jika query gagal, hapus file yang baru diupload
    if (!empty($_FILES['gambar']) && $_FILES['gambar']['size'] > 0 && file_exists($uploadpath)) {
        unlink($uploadpath);
    }
    
    echo "
    <script>
        let url = '../kereta.php';
        window.location.href = url;
        window.alert('Kereta Gagal di Edit: " . addslashes($stmt->error) . "');
    </script>
    ";
}

$stmt->close();
?>

