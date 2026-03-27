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
    $page = "beranda";
    include "nav.php";
    session_start();
    
    // ✅ VALIDASI DAN SANITASI INPUT
    $asal = isset($_GET['asal']) ? trim($_GET['asal']) : '';
    $tujuan = isset($_GET['tujuan']) ? trim($_GET['tujuan']) : '';
    $tgl = isset($_GET['tgl']) ? trim($_GET['tgl']) : '';
    
    // ✅ VALIDASI INPUT TIDAK KOSONG
    if (empty($asal) || empty($tujuan) || empty($tgl)) {
        die("Parameter pencarian tidak lengkap!");
    }
    
    // ✅ VALIDASI PANJANG INPUT
    if (strlen($asal) > 100 || strlen($tujuan) > 100 || strlen($tgl) > 10) {
        die("Input tidak valid!");
    }
    
    // ✅ VALIDASI FORMAT TANGGAL
    if (!DateTime::createFromFormat('Y-m-d', $tgl)) {
        die("Format tanggal tidak valid!");
    }
    
    $_SESSION['penumpang'] = isset($_GET['jumlah']) ? (int)$_GET['jumlah'] : 1;
    
    // ✅ VALIDASI JUMLAH PENUMPANG
    if ($_SESSION['penumpang'] <= 0 || $_SESSION['penumpang'] > 100) {
        die("Jumlah penumpang tidak valid!");
    }
    ?>
<br><br>
    <main class="container-fluid">
        <div class="container bg-warning">
            <hr>
            <h2 class="text-center text-dark">LIST TIKET</h2>
            <hr>
            <div class="text-center">
                <a href="index.php"><button class="btn btn-primary"><i class="fas fa-search"></i> Ganti Pencarian</button></a>
            </div>
            <hr>
            <table class="table table-striped table-hover text-dark" >
                <thead>
                    <tr>
                        <th>Kode Kereta</th>
                        <th>Rute</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Class</th>
                        <th>Harga</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // ✅ MENGGUNAKAN PREPARED STATEMENT (AMAN DARI SQL INJECTION)
                    $stmt = $koneksi->prepare("SELECT * FROM tiket WHERE dari = ? AND ke = ? AND tanggal = ?");
                    
                    if (!$stmt) {
                        die("Error preparing statement: " . $koneksi->error);
                    }
                    
                    $stmt->bind_param("sss", $asal, $tujuan, $tgl);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    while($d = $result->fetch_assoc()){
                    ?>
                    <tr class="text-white">
                        <td><?= htmlspecialchars($d['kode_kereta'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($d['dari'], ENT_QUOTES, 'UTF-8') ?> ke <?= htmlspecialchars($d['ke'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($d['tanggal'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($d['jam'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($d['class'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($d['harga'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><a href="identitas.php?tiket=<?= urlencode($d['id']) ?>"><i class="fas fa-shopping-basket"></i></a></td>
                    </tr>
                    <?php
                    }
                    $stmt->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include "footer.php";?>
</body>

</html>
