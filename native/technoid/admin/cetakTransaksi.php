<?php
session_start();
require '../function/bantuan.php';
require '../function/koneksi.php';

if (cekLoginAdmin() === false) {
    $_SESSION['pesan'] = "Anda belum masuk!! Silahkan masuk terlebih dahulu!";
    header('location:' . url . 'user/masuk.php');
}

global $konek;

$result = mysqli_query($konek, "SELECT * FROM transaksi JOIN status ON status.id_status = transaksi.id_status WHERE transaksi.id_status = '3' ");
$trans = [];
while ($tran = mysqli_fetch_object($result)) {
    $trans[] = $tran;
}


?>
<?php
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= url ?>assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= url ?>assets/font-awesome/css/font-awesome.min.css" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= url ?>assets/css/custom.css" crossorigin="anonymous">

    <title>Data Transaksi</title>
</head>

<body class="bg-light">
    <div id="transaksi" class="container my-5 bg-white py-3">
        <h3 class="text-center pb-3 font-weight-bold">DATA TRANSAKSI PENJUALAN BARANG</h3>
        <h6 class="float-right">Cetak pada : <?= date('h:i:s, Y-m-d') ?></h6>
        <table class="table table-striped">
            <thead>
                <tr class="bg-primary">
                    <th scope="col" style="width: 5%">#</th>
                    <th scope="col">ID Pesan</th>
                    <th scope="col">Pembeli</th>
                    <th scope="col">Penerima</th>
                    <th scope="col">Telp.</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Kuantiti</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <th scope="col">Pesan</th>
                    <th scope="col">Kirim</th>
                    <th scope="col">Terima</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trans as $key => $value) : ?>
                    <tr>
                        <th scope="row"><?= $key + 1 ?></th>
                        <td><?= $value->id_pesan ?></td>
                        <td><?= $value->id_user ?></td>
                        <td><?= $value->penerima ?></td>
                        <td><?= $value->telepon ?></td>
                        <td><?= $value->alamat ?></td>
                        <td><?= $value->kuantiti_total ?></td>
                        <td><?= $value->total_akhir ?></td>
                        <td><?= $value->keterangan ?></td>
                        <td><?= $value->pesan_at ?></td>
                        <td><?= $value->kirim_at ?></td>
                        <td><?= $value->terima_at ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= url; ?>assets/js/jquery-3.5.1.js" crossorigin="anonymous"></script>
    <script src="<?= url; ?>assets/js/pooper.js" crossorigin="anonymous"></script>
    <script src="<?= url; ?>assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="<?= url ?>assets/js/sweetalert2.all.js" crossorigin="anonymous"></script>
    <script src="<?= url ?>assets/js/tableHTMLExport.js" crossorigin="anonymous"></script>
    <script src="<?= url ?>assets/js/jspdf.min.js" crossorigin="anonymous"></script>
    <script src="<?= url ?>assets/js/jspdf.plugin.autotable.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?= url ?>assets/js/pdfmake.min.js"></script>
    <script type="text/javascript" src="<?= url ?>assets/js/html2canvas.min.js"></script>
    <!-- Custom Javascript -->


    <script>
        $("document").ready(function() {
            html2canvas($('#transaksi')[0], {
                onrendered: function(canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("data-transaksi.pdf");
                }
            });
        });
    </script>


</body>

</html>