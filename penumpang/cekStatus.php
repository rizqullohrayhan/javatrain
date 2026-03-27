<?php
require('koneksi.php');
date_default_timezone_set("Asia/Jakarta");

// ✅ VALIDASI DAN SANITASI NIK
$nik = isset($_GET['nik']) ? trim($_GET['nik']) : '';

if (empty($nik)) {
    die("NIK tidak valid!");
}

// ✅ VALIDASI FORMAT NIK (16 digit)
if (!preg_match('/^\d{16}$/', $nik)) {
    die("Format NIK tidak valid!");
}

// ✅ MENGGUNAKAN PREPARED STATEMENT (AMAN DARI SQL INJECTION)
$stmt = $koneksi->prepare("SELECT * FROM log_pesan WHERE nik = ?");
$stmt->bind_param("s", $nik);
$stmt->execute();
$result = $stmt->get_result();

$now = time();
while($j = $result->fetch_assoc()) {
    if($j['status'] == "Pending"){
        $id = $j['id'];
        if(date("H:i:s", $now) > date("H:i:s", strtotime($j["expired"]))) {
            // ✅ UPDATE MENGGUNAKAN PREPARED STATEMENT
            $stmt_update = $koneksi->prepare("UPDATE log_pesan SET status = 'Expired' WHERE id = ?");
            $stmt_update->bind_param("i", $id);
            $stmt_update->execute();
            $stmt_update->close();
        }
    }
}
$stmt->close();
?>