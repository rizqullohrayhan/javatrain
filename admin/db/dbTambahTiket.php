<?php
require('../koneksi.php');
$kereta = $_POST['kereta'];
$asal = $_POST['asal'];
$tujuan = $_POST['tujuan'];
$tgl = $_POST['tgl'];
$jam = $_POST['jam'];
$harga = $_POST['harga'];
$class = $_POST['class'];
$cek = mysqli_query($koneksi, "INSERT INTO tiket (kode_kereta, dari, ke, tanggal, jam, class, harga)
                                VALUE ('$kereta', '$asal', '$tujuan', '$tgl', '$jam', '$class', '$harga')");
if ($cek) {
    echo "
    <script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Tiket berhasil ditambahkan');
    </script>
    ";
}else {
    echo "
    <script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Tiket gagal ditambahkan');
    </script>
    ";
}
?>