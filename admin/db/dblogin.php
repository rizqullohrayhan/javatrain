<?php
require('../koneksi.php');
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $login = mysqli_query($koneksi, "SELECT * FROM login WHERE username='$username' AND password='$password'");
  	$cek = mysqli_num_rows($login);
    if ($cek != 0) {
        $_SESSION['login'] = 'admin';
?>
        <script>
            let url = '../index.php';
            window.location.href = url;
            window.alert("Selamat Datang Admin");
        </script>
<?php
    }else{
        echo "
        <script>
            let url = '../login.php';
            window.location.href = url;
            window.alert('Username atau Password Anda salah!');
        </script>
        ";
    }
}
?>