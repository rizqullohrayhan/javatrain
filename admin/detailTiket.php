<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/javatrain.png" type="image/x-icon">
    <title>Admin - Tiket</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        $page='tiket';
        include('side-nav.php');
        $id = $_GET['id'];
        $data = mysqli_query($koneksi, "SELECT kereta.kode_kereta, nama_kereta,
                                        dari, ke, tanggal, jam, class, harga, img_kereta
                                        FROM tiket LEFT JOIN kereta
                                        ON tiket.kode_kereta=kereta.kode_kereta
                                        WHERE tiket.id='$id'");
        $d = mysqli_fetch_array($data);
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
                            <h6 class="m-0 font-weight-bold text-primary">Detail Tiket</h6>
                            <a href="tiket.php"><button class="btn btn-success btn-sm">Kembali</button></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td rowspan="6" style="width: 304px;"><img src="img/kereta/<?= $d['img_kereta'] ?>" alt="img" width="300px" height="300px"></td>
                                            <td>Kereta</td>
                                            <td><?= $d['kode_kereta']?> <?= $d['nama_kereta']?></td>
                                        </tr>
                                        <tr>
                                            <td>Rute</td>
                                            <td><?= $d['dari']?> ke <?= $d['ke']?></td>
                                        </tr>
                                        <tr>
                                            <td>Class</td>
                                            <td><?= $d['class']?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Berangkat</td>
                                            <td><?= $d['tanggal']?></td>
                                        </tr>
                                        <tr>
                                            <td>Jam Berangkat</td>
                                            <td><?= $d['jam']?></td>
                                        </tr>
                                        <tr>
                                            <td>Harga</td>
                                            <td><?= $d['harga']?></td>
                                        </tr>
                                    </tbody>
                                </table>
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