<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/javatrain.png" type="image/x-icon">
    <title>Admin - Kereta</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        $page='tiket';
        include('side-nav.php');
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <br><br>
            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tiket</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Tiket</h6>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <form action="db/dbTambahTiket.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label" for="kereta">Kereta</label>
                                            <select class="form-select" name="kereta" id="kereta" required>
                                                <?php
                                                    $dataKereta = mysqli_query($koneksi, "SELECT * FROM kereta");
                                                    while($dk = mysqli_fetch_array($dataKereta)){
                                                ?>
                                                <option value="<?= $dk['kode_kereta'] ?>"><?= $dk['kode_kereta'] ?> <?= $dk['nama_kereta'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="harga">Harga</label>
                                            <input type="number" name="harga" id="harga" class="form-control" placeholder="isi angka saja" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label" for="asal">Stasiun Asal</label>
                                                <select class="form-select" name="asal" id="asal" required>
                                                    <?php
                                                        $dataStasiun = mysqli_query($koneksi, "SELECT * FROM stasiun ORDER BY nama_stasiun");
                                                        while($ds = mysqli_fetch_array($dataStasiun)){
                                                    ?>
                                                        <option value="<?= $ds['nama_stasiun'] ?>"><?= $ds['nama_stasiun'] ?></option>
                                                    <?php } ?>
                                                </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Stasiun Tujuan</label>
                                                <select class="form-select" name="tujuan" required>
                                                    <?php
                                                        $dataStasiun = mysqli_query($koneksi, "SELECT * FROM stasiun ORDER BY nama_stasiun");
                                                        while($ds = mysqli_fetch_array($dataStasiun)){
                                                    ?>
                                                        <option value="<?= $ds['nama_stasiun'] ?>"><?= $ds['nama_stasiun'] ?></option>
                                                    <?php } ?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="tgl" class="form-label">Tanggal Berangkat</label>
                                            <input type="date" class="form-control" name="tgl" id="tgl" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="jam" class="form-label">Jam Berangkat</label>
                                            <input type="time" name="jam" id="jam" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Class</label>
                                            <div class="col-md-7">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="class" id="inlineRadio1" value="Eksekutif" required>
                                                    <label class="form-check-label" for="inlineRadio1">Eksekutif</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="class" id="inlineRadio2" value="Bisnis">
                                                    <label class="form-check-label" for="inlineRadio2">Bisnis</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="class" id="inlineRadio3" value="Ekonomi">
                                                    <label class="form-check-label" for="inlineRadio3">Ekonomi</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="float-right">
                                        <button type="reset" class="btn btn-dark">Reset</button>
                                        <button type="submit" name="tiket" class="btn btn-dark">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; JAVATRAIN 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>