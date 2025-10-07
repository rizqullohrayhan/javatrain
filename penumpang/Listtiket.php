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
    $asal = $_GET['asal'];
    $tujuan = $_GET['tujuan'];
    $tgl = $_GET['tgl'];
    $_SESSION['penumpang'] = $_GET['jumlah'];
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
                    $query = "SELECT * FROM tiket WHERE dari='$asal' AND ke='$tujuan' AND tanggal='$tgl'";
                    $data = mysqli_query($koneksi, $query) or die("Query error : " . mysqli_error($data));
                    while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr class="text-white">
                        <td><?= $d['kode_kereta'] ?></td>
                        <td><?= $d['dari'] ?> ke <?= $d['ke'] ?></td>
                        <td><?= $d['tanggal'] ?></td>
                        <td><?= $d['jam'] ?></td>
                        <td><?= $d['class'] ?></td>
                        <td><?= $d['harga'] ?></td>
                        <td><a href="identitas.php?tiket=<?= $d['id'] ?>"><i class="fas fa-shopping-basket"></i></a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include "footer.php";?>
</body>

</html>
