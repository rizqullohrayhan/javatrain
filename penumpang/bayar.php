<html>

<head>
    <link rel="icon" href="image/javatrain.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/materialize.min.js"></script>
</head>

<body>
    <?php
    $page = "beranda";
    include "nav.php";
    session_start();
    
    // ✅ VALIDASI SESSION SEBELUM DIGUNAKAN
    if (!isset($_SESSION['tiket']) || !isset($_SESSION['penumpang'])) {
        echo "
        <script>
            window.location.href = 'index.php';
            window.alert('Session tidak valid! Silakan mulai dari awal.');
        </script>
        ";
        exit;
    }
    
    // ✅ VALIDASI DAN SANITASI INPUT POST
    $nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
    $nik = isset($_POST['nik']) ? trim($_POST['nik']) : '';
    
    // Validasi tidak kosong
    if (empty($nama) || empty($nik)) {
        echo "
        <script>
            window.location.href = 'identitas.php';
            window.alert('Nama dan NIK harus diisi!');
        </script>
        ";
        exit;
    }
    
    // Validasi panjang dan format NIK
    if (!preg_match('/^\d{16}$/', $nik)) {
        echo "
        <script>
            window.location.href = 'identitas.php';
            window.alert('NIK harus berupa 16 angka!');
        </script>
        ";
        exit;
    }
    
    // Validasi panjang nama
    if (strlen($nama) > 100) {
        echo "
        <script>
            window.location.href = 'identitas.php';
            window.alert('Nama terlalu panjang (maksimal 100 karakter)!');
        </script>
        ";
        exit;
    }
    
    $_SESSION['nama'] = $nama;
    $_SESSION['nik'] = $nik;
    
    // ✅ GUNAKAN PREPARED STATEMENT UNTUK QUERY DATABASE
    $tiket_id = filter_var($_SESSION['tiket'], FILTER_VALIDATE_INT);
    if ($tiket_id === false) {
        die("ID Tiket tidak valid!");
    }
    
    $stmt = $koneksi->prepare("SELECT * FROM tiket WHERE id = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $koneksi->error);
    }
    
    $stmt->bind_param("i", $tiket_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        die("Tiket tidak ditemukan!");
    }
    
    $d = $result->fetch_array();
    $stmt->close();
    
    $harga = (int) $d['harga'];
    $jml = (int) $_SESSION['penumpang'];
    $_SESSION['total'] = $harga * $jml;
    $_SESSION['kode'] = uniqid('JAVATRAIN_', true);
    ?>
    <br><br>
    <div class="d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-lg-6">
                    <div class="card bg-dark text-white">
                        <div class="card-body ">
                            <form class="mb-3" action="log_pesan.php" method="POST">
                                <h2 class="fw-bold mb-2 text-uppercase ">Pembayaran</h2>
                                <table class="text-white"  style="width: 100%;">
                                    <tr>
                                        <td>Kode Pembayaran</td>
                                        <td> : <?= htmlspecialchars($_SESSION['kode']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Harga Tiket</td>
                                        <td> : Rp<?= number_format($harga, 0, '', '.') ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Penumpang</td>
                                        <td> : <?= $jml ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total Harga</td>
                                        <td> : Rp<?= number_format($_SESSION['total'], 0, '', '.') ?></td>
                                    </tr>
                                </table>
                                <br>
                                <input type="hidden" name="harga" value="<?= htmlspecialchars($_SESSION['total']) ?>" required>
                                <div class="d-grid">
                                    <input class="btn btn-info" type="submit" value="Booking">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php";?>
</body>

</html>