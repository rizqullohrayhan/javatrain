<?php
require('koneksi.php');
$id = $_GET['id'];
$nik = $_GET['nik'];
$cek = mysqli_query($koneksi, "SELECT * FROM log_pesan WHERE id='$id'");
$c = mysqli_fetch_array($cek);
if($c['status']!="Expired"){
    $query = "UPDATE log_pesan SET status='Lunas' WHERE id='$id'";
}else{
    $query = 0;
}
$lunas = mysqli_query($koneksi, $query);
if ($lunas) {
    echo "
    <script>
        let url= 'cekPesanan.php?nik=".$nik."';
        window.location.href = url;
        window.alert('Pembayaran berhasil');
    </script>
    ";
} else {
    echo "
    <script>
        let url= 'cekPesanan.php?nik=".$nik."';
        window.location.href = url;
        window.alert('Pembayaran gagal');
    </script>
    ";
}
