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
    ?>
<br><br>
    <main class="container-fluid">
        <div class=" container p-2 rounded bg-info text-white">
            <h1>Pesan Tiket</h1>
            <form class="row g-3" action="Listtiket.php" method='GET'>
                <div class="col-md-3">
                    <label class="form-label">Stasiun Asal</label>
                    <div class="input-group">
                        <select class="form-select" name="asal" required>
                            <?php
                                $dataStasiun = mysqli_query($koneksi, "SELECT * FROM stasiun ORDER BY nama_stasiun");
                                while($da = mysqli_fetch_array($dataStasiun)){
                            ?>
                                <option value="<?= $da['nama_stasiun'] ?>"><?= $da['nama_stasiun'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Stasiun Tujuan</label>
                    <div class="input-group">
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
                <div class="col-md-3">
                    <label class="form-label">Jumlah Orang</label>
                    <input class="form-control" min="1" max="10" type="number" name="jumlah" required>
                    <div class="invalid-feedback">
                        Harap pilih jumlah orang.
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="tgl" aria-describedby="inputGroupPrepend" required>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" name="cari" class="btn btn-primary"><i class="fas fa-search"></i> Cari Tiket</button>
                </div>
            </form>
        </div>
    </main>
  
    <?php include "footer.php";?>
</body>

</html>
