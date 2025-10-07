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
    // unset($_SESSION['jml_orang']);
    ?>
<br><br>
<div class="d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-lg-6">
                    <div class="card bg-info text-white">
                        <div class="card-body ">
                            <form class="mb-3" action="cekPesanan.php" method="GET">
                                <h2 class="fw-bold mb-2 text-uppercase ">Cek Pesanan</h2>
                                <div class="mb-3">
                                    <label for="username" class="form-label ">NIK</label>
                                    <input type="text" name="nik" class="form-control" id="username" required>
                                </div>
                                <div class="d-grid">
                                    <input class="btn btn-primary" type="submit" value="Cek">
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
