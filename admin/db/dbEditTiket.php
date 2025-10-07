<?php
require('../koneksi.php');
$id = $_POST['id'];
$kereta = $_POST['kereta'];
$asal = $_POST['asal'];
$tujuan = $_POST['tujuan'];
$tgl = $_POST['tgl'];
$jam = $_POST['jam'];
$harga = $_POST['harga'];
$class = $_POST['class'];
$cek = mysqli_query($koneksi, "UPDATE tiket SET kode_kereta='$kereta', dari='$asal', ke='$tujuan', tanggal='$tgl',
                                jam='$jam', class='$class', harga='$harga'
                                WHERE id='$id'");
if ($cek) {
    echo "
    <script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Tiket berhasil diedit');
    </script>
    ";
}else {
    echo "
    <script>
        let url = '../tiket.php';
        window.location.href = url;
        window.alert('Tiket gagal diedit');
    </script>
    ";
}
?>