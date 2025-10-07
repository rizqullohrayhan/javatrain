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
    $_SESSION['nama'] = $_POST['nama'];
    $_SESSION['nik'] = $_POST['nik'];
    $data = mysqli_query($koneksi, "SELECT * FROM tiket WHERE id='".$_SESSION['tiket']."'");
    $d = mysqli_fetch_array($data);
    $harga = (int) $d['harga'];
    $jml = (int) $_SESSION['penumpang'];
    $_SESSION['total'] = $harga*$jml;
    $_SESSION['kode'] = uniqid();
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
                                        <td> : <?= $_SESSION['kode'] ?></td>
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
                                <input type="hidden" name="harga" value="<?= $tot ?>" required>
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
