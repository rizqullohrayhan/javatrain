<?php
require('../koneksi.php');
session_start();

if (isset($_POST['login'])) {
    // Sanitasi input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Validasi input tidak kosong
    if (empty($username) || empty($password)) {
        echo "
        <script>
            let url = '../login.php';
            window.location.href = url;
            window.alert('Username dan Password tidak boleh kosong!');
        </script>
        ";
        exit;
    }
    
    // ✅ MENGGUNAKAN PREPARED STATEMENT (AMAN DARI SQL INJECTION)
    $stmt = $koneksi->prepare("SELECT * FROM login WHERE username = ? AND password = ?");
    
    if (!$stmt) {
        die("Error preparing statement: " . $koneksi->error);
    }
    
    // Bind parameters: "ss" = string, string
    $stmt->bind_param("ss", $username, $password);
    
    // Execute statement
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }
    
    // Get result
    $result = $stmt->get_result();
    $cek = $result->num_rows;
    
    if ($cek != 0) {
        $_SESSION['login'] = 'admin';
        $_SESSION['login_time'] = time(); // Tambahan: track waktu login
        ?>
        <script>
            let url = '../index.php';
            window.location.href = url;
            window.alert("Selamat Datang Admin");
        </script>
        <?php
    } else {
        echo "
        <script>
            let url = '../login.php';
            window.location.href = url;
            window.alert('Username atau Password Anda salah!');
        </script>
        ";
    }
    
    $stmt->close();
}
?>