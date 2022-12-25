<?php
require '../function/admin.php';
if (cekLoginAdmin() === false) {
    $_SESSION['pesan'] = "Anda belum masuk!! Silahkan masuk terlebih dahulu!";
    header('location:' . url . 'user/masuk.php');
}

$judul = ambilTransaksi()['judul'];
$transaksi = ambilTransaksi()['trans'];

if (isset($_POST['verifi'])) {
    verifiTransaksi($_POST);
}
if (isset($_POST['kirim'])) {
    kirimTransaksi($_POST);
}

//pencarian
$dataUrl = "transaksi";

require 'template_admin/header.php';
?>

<div class="row py-3 px-3 bg-light">
    <div class="col-md">
        <a href="" class="text-decoration-none text-primary">
            <h5 id="judul" class="text-uppsercase ">TRANSAKSI</h5>
        </a>
    </div>
    <div class="col-md d-flex justify-content-end">
        <a id="btn-transaksi" class="text-primary mr-5" style="cursor: pointer">
            <h6 class="float-right">Transaksi Selesai &raquo;</h6>
        </a>
        <a href="<?= url ?>admin/cetakTransaksi.php" class="text-decoration-none text-dark d-flex"><i class="fa fa-download mr-2"></i>
            <h6> Cetak PDF</h6>
        </a>
    </div>
</div>

<table class="transaksi table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID PESAN</th>
            <th scope="col">PENERIMA</th>
            <th scope="col">PENGIRIM</th>
            <th scope="col">JUMLAH</th>
            <th scope="col">TOTAL HARGA</th>
            <th scope="col" class="text-center">STATUS</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transaksi as $key => $value) : ?>
            <tr>
                <th scope="row"><?= $key + 1 ?></th>
                <td><?= $value->id_pesan ?></td>
                <td><?= $value->penerima ?></td>
                <td><?= $value->pengirim ?></td>
                <td><?= $value->kuantiti_total ?></td>
                <td>Rp<?= number_format($value->total_akhir, 0) ?></td>
                <td class="text-center">
                    <?php if ($value->id_status == 0 && $value->pembayaran == 0) : ?>
                        <span class=" badge badge-warning">Menungggu pembayaran</span>
                    <?php elseif ($value->id_status == 0 && $value->pembayaran == 1) : ?>
                        <span class=" badge badge-warning">Verifikasi pembayaran</span>
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#cek-bayar<?= $value->id_pesan ?>">
                            Cek
                        </button>
                    <?php elseif ($value->id_status == 1 && $value->pembayaran == 1) : ?>
                        <form action="" method="post">
                            <input type="hidden" name="idpesan" value="<?= $value->id_pesan ?>">
                            <button name="kirim" class="btn btn-sm btn-primary">
                                Kirim
                            </button>
                        </form>
                    <?php elseif ($value->id_status == 2) : ?>
                        <span class=" badge badge-primary"><?= $value->keterangan ?></span>
                    <?php elseif ($value->id_status == 3) : ?>
                        <span class="badge badge-success"><?= $value->keterangan ?></span>
                    <?php endif; ?>
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detail<?= $value->id_pesan ?>">Detail</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require 'template_admin/footer.php' ?>