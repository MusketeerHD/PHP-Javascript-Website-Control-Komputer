<?php
session_start();
require '../function/detail.php';



if (isset($_GET['id'])) {
    $produk = detail($_GET['id'])['produk'];
    $judul = detail($_GET['id'])['judul'];
     histori($_GET['id']);	
}

if (isset($_POST['cart'])) {
    if (cekLogin() === true) {
        tambahCart($_POST);
    } else {
        $_SESSION['pesan'] = "Anda belum masuk!! Silahkan masuk terlebih dahulu!";
    }
}

require 'templates/header.php'; ?>
<div class="row mt-5 pt-5">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header d-flex justify-content-center">
                <img src="<?= url ?>assets/images/produk/<?= $produk->gambar ?>" alt="">
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-4">
                            <h6>Nama</h6>
                        </div>
                        <div class="col-sm">: <?= $produk->nama ?></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-4">
                            <h6>Harga</h6>
                        </div>
                        <div class="col-sm">: Rp<?= number_format($produk->harga) ?></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-4">
                            <h6>Stok</h6>
                        </div>
                        <div class="col-sm">: <?= $produk->stok ?></div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-white">
                <div class="row ">
                    <div class="col-2">
                        <h6>Kategori</h6>
                    </div>
                    <div class="col-10">
                        : <?= $produk->kategori ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="card-title">Deskripsi produk :</h6>
                <p class="card-text"><?= $produk->deskripsi ?></p>
                <form method="POST" action="">
                    <input type="hidden" name="id_produk" value="<?= $produk->id_produk ?>">
                    <input type="hidden" name="nama" value="<?= $produk->nama ?>">
                    <input type="hidden" name="harga" value="<?= $produk->harga ?>">
                    <input type="hidden" name="kuantiti" value="1">
                    <input type="hidden" name="gambar" value="<?= $produk->gambar ?>">
                    <input type="hidden" name="kategori" value="<?= $produk->kategori ?>">
                    <button name="cart" class="btn btn-sm btn-success">Beli</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'templates/footer.php' ?>