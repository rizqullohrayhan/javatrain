<?php
require('../koneksi.php');
$id = $_GET['id'];
$cek = mysqli_query($koneksi, "DELETE FROM stasiun WHERE id='$id'");
if ($cek) {
    echo "
    <script>
        let url = '../stasiun.php';
        window.location.href = url;
    </script>
    ";
} else {
    echo "
    <script>
        let url = '../stasiun.php';
        window.location.href = url;
        window.alert('Stasiun gagal dihapus!');
    </script>
    ";
}
