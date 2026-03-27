<?php
require('../koneksi.php');

// ✅ VALIDASI DAN SANITASI INPUT
$nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
$kode = isset($_POST['kode']) ? trim($_POST['kode']) : '';

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

$gambar = NULL;

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
    
    // Generate nama file unik untuk keamanan
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
$stmt = $koneksi->prepare("INSERT INTO kereta (nama_kereta, kode_kereta, img_kereta) VALUES (?, ?, ?)");

if (!$stmt) {
    die("Error preparing statement: " . $koneksi->error);
}

$stmt->bind_param("sss", $nama, $kode, $gambar);

if ($stmt->execute()) {
    echo "
    <script>
        let url = '../kereta.php';
        window.location.href = url;
        window.alert('Kereta berhasil ditambahkan');
    </script>
    ";
} else {
    // Jika query gagal, hapus file yang sudah diupload
    if ($gambar && file_exists($uploadpath)) {
        unlink($uploadpath);
    }
    
    echo "
    <script>
        let url = '../kereta.php';
        window.location.href = url;
        window.alert('Kereta gagal ditambahkan: " . addslashes($stmt->error) . "');
    </script>
    ";
}

$stmt->close();
?>
