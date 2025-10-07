<?php
require('../koneksi.php');
$nama = $_POST['nama'];
$kode = $_POST['kode'];
$uploadfile = '../img/kereta/' . $_FILES['gambar']['name'];
$cek = move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadfile);
$gambar = $_FILES['gambar']['name'];
mysqli_query($koneksi, "INSERT INTO kereta (nama_kereta, kode_kereta, img_kereta) VALUE ('$nama','$kode','$gambar')");
?>
<script>
    let url = "../kereta.php";
    window.location.href = url;
</script>