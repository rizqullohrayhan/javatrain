<?php
require('../koneksi.php');
$id = $_POST['id'];
$kode = $_POST['kode'];
$nama = $_POST['nama'];

$data = mysqli_query($koneksi, "SELECT * FROM kereta WHERE id='$id'");
$d = mysqli_fetch_array($data);
$gambar =  $d["img_kereta"];
if (!empty($_FILES['gambar'])) {
    $uploadfile = '../img/kereta/' . $_FILES['gambar']['name'];
    $cek = move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadfile);
    if($cek){
        $gambar = $_FILES['gambar']['name'];
    }
}

$edit = mysqli_query($koneksi, "UPDATE kereta SET nama_kereta='$nama', kode_kereta='$kode', img_kereta='$gambar'");
if ($edit) {
    echo "
    <script>
        let url = '../kereta.php';
        window.location.href = url;
        window.alert('Kereta Berhasil di Edit');
    </script>
    ";
} else {
    echo "
    <script>
        let url = '../kereta.php';
        window.location.href = url;
        window.alert('Kereta Gagal di Edit');
    </script>
    ";
}
