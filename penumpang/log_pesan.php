<?php
require('koneksi.php');
session_start();
date_default_timezone_set("Asia/Jakarta");
if (isset($_POST)) {
    $expired1 = time() + 600;
    $expired = date("H:i:s", $expired1);
    $waktu = time();
    $jam = date("Y-m-d H:i:s", $waktu);
    $cek = mysqli_query($koneksi, "INSERT INTO log_pesan (kode_bayar, id_tiket, penumpang, nama, nik, harga, expired, jam_booking) VALUE
                                    ('{$_SESSION['kode']}', '{$_SESSION['tiket']}', '{$_SESSION['penumpang']}',
                                     '{$_SESSION['nama']}', '{$_SESSION['nik']}', '{$_SESSION['total']}', '$expired', '$jam')");
    if ($cek) {
        session_destroy();
        echo "
        <script>
        let url = 'index.php';
        window.location.href = url;
        window.alert('Tiket Berhasil diBooking! Harap bayar dalam waktu 10 menit setelah memboking!!!');
        </script>
        ";
    } else {
        echo "
        <script>
        let url = 'index.php';
        window.location.href = url;
        window.alert('Gagal membooking tiket!');
        </script>
        ";
    }
} else {
    echo "
    <script>
    let url = 'index.php';
    window.location.href = url;
    window.alert('Gagal membooking tiket! Harap isi semua data dengan benar!');
    </script>
    ";
}