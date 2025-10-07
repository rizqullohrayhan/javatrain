<?php
require('koneksi.php');
date_default_timezone_set("Asia/Jakarta");
$nik = $_GET['nik'];
$jam = mysqli_query($koneksi, "SELECT * FROM log_pesan WHERE nik='$nik'");
$now = time();
while($j = mysqli_fetch_array($jam)){
    if($j['status']=="Pending"){
        // $expired = $j[expired];
        $id = $j['id'];
        if(date("H:i:s",$now)>date("H:i:s", strtotime($j["expired"]))){
            mysqli_query($koneksi, "UPDATE log_pesan SET status='Expired' WHERE id='$id'");
        }
    }
}
?>