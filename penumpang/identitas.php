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
    
    // ✅ VALIDASI DAN SANITASI GET PARAMETER SEBELUM MENYIMPAN KE SESSION
    if (!isset($_GET['tiket'])) {
        echo "
        <script>
            window.location.href = 'index.php';
            window.alert('Parameter tidak valid!');
        </script>
        ";
        exit;
    }
    
    // Validasi bahwa tiket adalah integer
    $tiket = filter_var($_GET['tiket'], FILTER_VALIDATE_INT);
    
    if ($tiket === false) {
        echo "
        <script>
            window.location.href = 'index.php';
            window.alert('ID Tiket harus berupa angka!');
        </script>
        ";
        exit;
    }
    
    // Simpan ke session (sudah divalidasi)
    $_SESSION['tiket'] = $tiket;
    ?>
    <br><br>
    <main class="container-fluid">
        <div class="container p-2 rounded bg-info text-white">
            <h2>Identitas Penumpang</h2>
            <br>
            <form class="row g-3" action="bayar.php" method="post">
                <div class="col-4">
                    <label class="form-label">Nama Lengkap Pemboking</label>
                    <input name="nama" type="text" maxlength="100" class="form-control" 
                           placeholder="Masukkan Nama Anda" required 
                           pattern="[a-zA-Z\s]+" title="Nama hanya boleh mengandung huruf dan spasi">
                </div>
                <div class="col-4">
                    <label class="form-label">NIK Pemboking</label>
                    <input name="nik" type="text" maxlength="16" class="form-control" 
                           placeholder="Masukkan NIK Anda (16 angka)" required 
                           pattern="\d{16}" title="NIK harus berupa 16 angka">
                </div>
                <div class="col-12">
                    <input type="submit" class="btn btn-dark" value="Lanjut">
                </div>
            </form>
        </div>
    </main>
    <?php include "footer.php";?>
</body>

</html>