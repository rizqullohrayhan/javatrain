<?php
require('../koneksi.php');
$id = $_GET['id'];
$cek = mysqli_query($koneksi, "DELETE FROM tiket WHERE id='$id'");
if ($cek) {
    echo "
    <script>
        let url = '../tiket.php';
        window.location.href = url;
    </script>
    ";
} else {
    echo "
    <script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Tiket gagal dihapus!');
    </script>
    ";
}
