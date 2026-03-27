<html>

<head>
    <link rel="icon" href="image/javatrain.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
</head>

<body>
    <?php
    $page = "pesanan";
    include "nav.php";
    require("cekStatus.php");
    
    // ✅ VALIDASI DAN SANITASI NIK (dari cekStatus.php)
    // variabel $nik sudah divalidasi di cekStatus.php
    
    // ✅ NIK SUDAH DIVALIDASI DI cekStatus.php, SEKARANG BUAT QUERY AMAN
    $stmt = $koneksi->prepare("SELECT log_pesan.expired, log_pesan.id, kode_kereta, dari, ke, tanggal, penumpang, log_pesan.harga, status, class FROM log_pesan JOIN tiket ON log_pesan.id_tiket=tiket.id WHERE nik = ? ORDER BY jam_booking");
    
    if (!$stmt) {
        die("Error preparing statement: " . $koneksi->error);
    }
    
    $stmt->bind_param("s", $nik);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
<br><br>
    <main class="container-fluid">
        <div class="container bg-dark">
            <hr>
            <h2 class="text-center text-white">LIST TIKET</h2>
            <hr>
            <table class="table table-striped table-hover text-white" >
                <thead>
                    <tr>
                        <th>Kode Kereta</th>
                        <th>Rute</th>
                        <th>Tanggal</th>
                        <th>Class</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while($d = $result->fetch_assoc()){
                    ?>
                    <tr class="text-white">
                        <td><?= htmlspecialchars($d['kode_kereta'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($d['dari'], ENT_QUOTES, 'UTF-8') ?> ke <?= htmlspecialchars($d['ke'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($d['tanggal'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($d['class'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($d['penumpang'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($d['harga'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td 
                        <?php
                            if($d['status']=="Lunas"){echo 'class="table-success"';}
                            else if($d['status']=="Pending"){echo 'class="table-warning"';}
                            else if($d['status']=="Expired"){echo 'class="table-danger"';}
                            if($d['status']=="Pending"){?>
                                title="Harap bayar sebelum <?= htmlspecialchars($d['expired'], ENT_QUOTES, 'UTF-8') ?>" 
                            <?php }
                        ?>
                        >
                            <?= htmlspecialchars($d['status'], ENT_QUOTES, 'UTF-8') ?>
                        </td>
                        <td><a href="lunas.php?id=<?= urlencode($d['id']) ?>&nik=<?= urlencode($nik) ?>"><i class="fas fa-money-check-alt"></i></a></td>
                    </tr>
                    <?php } 
                    $result->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include "footer.php";?>
</body>

</html>
