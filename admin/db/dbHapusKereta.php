<?php
require('../koneksi.php');
$id = $_GET['id'];
$cek = mysqli_query($koneksi, "DELETE FROM kereta WHERE id='$id'");
if ($cek) {
    echo "
    <script>
        let url = '../kereta.php';
        window.location.href = url;
    </script>
    ";
} else {
    echo "
    <script>
        let url = '../kereta.php';
        window.location.href = url;
        window.alert('Kereta gagal dihapus!');
    </script>
    ";
}
