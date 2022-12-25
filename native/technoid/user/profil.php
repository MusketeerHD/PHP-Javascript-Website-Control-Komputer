<?php
require '../function/pengguna.php';
require '../function/cart.php';
require '../function/transaksi.php';

$profil = profil();
$judul = $profil['judul'];
$user = $profil['pengguna'];

$cart = ambilCart()['carts'];
$subtotal = ambilCart()['subtotal']->subtotal;
if (isset($_POST['ubahCart'])) {
    ubahCart($_POST);
} else if (isset($_POST['hapusCart'])) {
    hapusCart($_POST);
} else if (isset($_POST['bersihkanCart'])) {
    bersihkanCart($_POST);
}

$transaksi = ambilTransaksi()['trans'];
if (isset($_POST['kirim'])) {
    bayar($_POST);
}

if (isset($_POST['terima'])) {
    terimaTransaksi($_POST);
}

require 'templates/header.php';
?>
<div class="row border mt-5 py-3">
    <div class="col-md-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-selected="true">Profil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-keranjang" data-toggle="pill" href="#keranjang" role="tab" aria-selected="false">Keranjang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-transaksi" data-toggle="pill" href="#transaksi" role="tab" aria-selected="false">Transaksi</a>
            </li>
        </ul>
    </div>
    <div class="col-md-12 ">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <ul class="list-group list-group-flush w-50">
                    <li class="list-group-item">
                        <img src="<? url ?>assets/images/user/<?= $user->image ?>" alt="">
                    </li>
                    <li class="list-group-item">
                        <h6 class="font-weight-bold">Nama</h6><?= $user->nama ?>
                    </li>
                    <li class="list-group-item">
                        <h6 class="font-weight-bold">Email</h6><?= $user->email ?>
                    </li>
                    <li class="list-group-item">
                        <h6 class="font-weight-bold">Terakhir masuk</h6><?= $_SESSION['tglMasuk'] ?>
                    </li>
                    <li class="list-group-item">
                        <h6 class="font-weight-bold">Daftar pada</h6><?= $user->createat ?>
                    </li>
                    <li class="list-group-item">
                        <h6 class="font-weight-bold"> Di perbarui pada</h6><?= $user->updateat ?>
                    </li>
                </ul>
            </div>
            <div class="tab-pane fade" id="keranjang" role="tabpanel" aria-labelledby="tab-keranjang">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" style="width: 10%">Gambar</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col" style="width: 10%">Kuantiti</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Aksi </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $key => $value) : ?>
                            <tr>
                                <th scope="row"><?= $key + 1 ?></th>
                                <td><img style="width: 100%" src="<?= url ?>assets/images/produk/<?= $value->gambar ?>" alt=""></td>
                                <td><a href="<?= url ?>user/produk.php/?id=<?= $value->id_produk ?>"><?= $value->nama ?></a></td>
                                <td>Rp<?= number_format($value->harga, 0) ?></td>

                                <form action="" method="POST">
                                    <td>
                                        <input class="form-control w-100" min="1" max="50" type="number" name="kuantiti" value="<?= $value->kuantiti ?>">
                                    </td>
                                    <td>Rp<?= number_format($value->total, 0) ?></td>
                                    <td>
                                        <input type="hidden" name="idCart" value="<?= $value->id_cart ?>">
                                        <input type="hidden" name="harga" value="<?= $value->harga ?>">
                                        <button name="hapusCart" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        <button name="ubahCart" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                                    </td>
                                </form>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Total :</td>
                            <td> Rp<?= number_format($subtotal, 0) ?> </td>
                        </tr>
                        <tr>
                            <form action="" method="POST">
                                <td><button name="bersihkanCart" class="btn btn-sm btn-success">Bersihkan isi keranjang</button></td>
                            </form>
                            <td><a class="btn btn-sm btn-success" href="<?= url ?>user/cekOut.php">Cekout</a></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="tab-pane fade" id="transaksi" role="tabpanel" aria-labelledby="tab-transaksi">
                <table class="table">
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
                        <?php foreach ($transaksi as $key => $trans) : ?>
                            <tr>
                                <th scope="row"><?= $key + 1 ?></th>
                                <td><?= $trans->id_pesan ?></td>
                                <td><?= $trans->penerima ?></td>
                                <td><?= $trans->pengirim ?></td>
                                <td><?= $trans->kuantiti_total ?></td>
                                <td>Rp<?= number_format($trans->total_akhir, 0) ?></td>
                                <td class="text-center">
                                    <?php if ($trans->id_status == 0 && $trans->pembayaran == 0) : ?>
                                        <span class=" badge badge-warning">Anda belum melakukan pembayaran</span>
                                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#bayar<?= $trans->id_pesan ?>">
                                            Bayar
                                        </button>
                                    <?php elseif ($trans->id_status == 0 && $trans->pembayaran == 1) : ?>
                                        <span class=" badge badge-warning">Menunggu verifikasi</span>
                                    <?php elseif ($trans->id_status == 1) : ?>
                                        <span class="badge badge-secondary"><?= $trans->keterangan ?></span>
                                    <?php elseif ($trans->id_status == 2) : ?>
                                        <span class="badge badge-primary"><?= $trans->keterangan ?></span>
                                        <form action="" method="POST">
                                            <input type="hidden" name="idpesan" value="<?= $trans->id_pesan ?>">
                                            <button name="terima" class="mt-1 btn btn-sm btn-primary">Terima</button>
                                        </form>
                                    <?php elseif ($trans->id_status == 3) : ?>
                                        <span class="badge badge-success"><?= $trans->keterangan ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detail<?= $trans->id_pesan ?>">Detail</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require 'templates/footer.php' ?>