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
    require("cekStatus.php");;
    // $nik = $_GET['nik'];
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
                    $query = "SELECT log_pesan.expired, log_pesan.id, kode_kereta, dari, ke, tanggal, penumpang, log_pesan.harga, status, class FROM log_pesan JOIN tiket ON log_pesan.id_tiket=tiket.id WHERE nik='$nik' ORDER BY jam_booking";
                    $data = mysqli_query($koneksi, $query);
                    while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr class="text-white">
                        <td><?= $d['kode_kereta'] ?></td>
                        <td><?= $d['dari'] ?> ke <?= $d['ke'] ?></td>
                        <td><?= $d['tanggal'] ?></td>
                        <td><?= $d['class'] ?></td>
                        <td><?= $d['penumpang'] ?></td>
                        <td><?= $d['harga'] ?></td>
                        <td 
                        <?php
                            if($d['status']=="Lunas"){echo 'class="table-success"';}
                            else if($d['status']=="Pending"){echo 'class="table-warning"';}
                            else if($d['status']=="Expired"){echo 'class="table-danger"';}
                            if($d['status']=="Pending"){?>
                                title="Harap bayar sebelum <?= $d['expired'] ?>" 
                            <?php }
                        ?>
                        >
                            <?= $d['status'] ?>
                        </td>
                        <td><a href="lunas.php?id=<?= $d['id'] ?>&nik=<?= $nik ?>"><i class="fas fa-money-check-alt"></i></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include "footer.php";?>
</body>

</html>
