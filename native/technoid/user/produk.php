<?php
session_start();
require '../function/produk.php';
$judul = produk()['judul'];


//keranjang
if (isset($_POST['cart'])) {
    if (cekLogin() === true) {
        tambahCart($_POST);
    } else {
        $_SESSION['pesan'] = "Anda belum masuk!! Silahkan masuk terlebih dahulu!";
    }
}

if (isset($_GET['kategori'])) {
    $produk =  kategoriProduk($_GET['kategori']);
} elseif (isset($_GET['cari'])) {
    $produk = cariProduk($_GET['cari']);
} else {
    $produk = produk()['produk'];
}


require 'templates/header.php';
?>
<div class="row mt-5">
    <div class="col py-3">
        <h4 class="text-uppercase">Cari produk sesukamu</h4>
    </div>
</div>
<!-- Produk Baru -->
<div class="row border-top">
    <?php foreach ($produk as $value) : ?>
        <div class="col-sm-3 my-2 card shadow-sm bg-white">
            <div class="card-img" style=" height:50%;">
                <img src="<?= url ?>assets/images/produk/<?= $value->gambar ?>" class="img-fluid " style="width: 100%;" alt="...">
            </div>
            <div class="py-0 card-body d-flex align-items-center flex-column-reverse text-center border-bottom">
                <h6 class=""><?= $value->nama ?></h6>
                <p>Rp<?= number_format($value->harga, 0) ?></p>
            </div>
            <div class="d-flex justify-content-around p-2 w-75 m-auto">
                <a href="<?= url ?>user/detail.php/?id=<?= $value->id_produk ?>" class="btn btn-sm btn-info mr-1 ">Detail</a>
                <form method="POST" action="">
                    <input type="hidden" name="id_produk" value="<?= $value->id_produk ?>">
                    <input type="hidden" name="nama" value="<?= $value->nama ?>">
                    <input type="hidden" name="harga" value="<?= $value->harga ?>">
                    <input type="hidden" name="kuantiti" value="1">
                    <input type="hidden" name="gambar" value="<?= $value->gambar ?>">
                    <input type="hidden" name="kategori" value="<?= $value->kategori ?>">
                    <button name="cart" class="btn btn-sm btn-success">Beli</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= require 'templates/footer.php'; ?>