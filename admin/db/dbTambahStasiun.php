<?php
require('../koneksi.php');
$nama = $_POST['nama'];
$cek = mysqli_query($koneksi, "INSERT INTO stasiun (nama_stasiun)
                                VALUE ('$nama')");
if ($cek) {
    echo "
    <script>
        let url = '../stasiun.php';
        window.location.href = url;
        window.alert('Stasiun berhasil ditambahkan');
    </script>
    ";
}else {
    echo "
    <script>
        let url = '../stasiun.php';
        window.location.href = url;
        window.alert('Stasiun gagal ditambahkan');
    </script>
    ";
}
?>