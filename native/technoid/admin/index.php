<?php
require '../function/admin.php';

if (cekLoginAdmin() != true) {
    $_SESSION['pesan'] = "Anda belum masuk!! Silahkan masuk terlebih dahulu!";
    header('location:' . url . 'user/masuk.php');
}

$judul = home()['judul'];
$jmlPd = home()['jmlPd'];

$transaksi = home()['trans'];

require 'template_admin/header.php';
?>

<div class="heading text-center bg-light mt-2 p-3 ">
    <div class="row text-left ">
        <div class="col-4 border-right">
            <h5>PRODUK</h5>
            <p> <?= $jmlPd ?> Produk</p>
        </div>
        <div class="col-4">
            <h5>TERJUAL</h5>
            <p><?= home()['jual']->jual ?> Produk</p>
        </div>
        <div class="col-4 border-left">
            <h5>PENGGUNA</h5>
            <p><?= home()['akun'] ?> Akun</p>
        </div>
    </div>
</div>

<table class="transaksi table mt-3">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID PESAN</th>
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
                <td><?= $value->kuantiti_total ?></td>
                <td>Rp<?= number_format($value->total_akhir, 0) ?></td>
                <td class="text-center">
                    <?php if ($value->id_status == 0 && $value->pembayaran == 0) : ?>
                        <span class=" badge badge-warning">Menunggu pembayaran</span>
                    <?php elseif ($value->id_status == 0 && $value->pembayaran == 1) : ?>
                        <span class=" badge badge-warning">Verifikasi pembayaran</span>
                    <?php elseif ($value->id_status == 2) : ?>
                        <span class=" badge badge-primary"><?= $value->keterangan ?></span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td>
                <a class="text-decoration-none" href="<?= url ?>admin/transaksi.php"> Lihat lainnya &raquo;</a>
            </td>
        </tr>
    </tfoot>
</table>

<?php require 'template_admin/footer.php' ?>