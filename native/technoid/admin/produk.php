<?php
require '../function/admin.php';
if (cekLoginAdmin() === false) {
    $_SESSION['pesan'] = "Anda belum masuk!! Silahkan masuk terlebih dahulu!";
    header('location:' . url . 'user/masuk.php');
}

if (isset($_POST['hapus'])) {
    $id = $_GET['id'];
    hapusProduk($id);
}

//---- Variabel Hasil Kueri ----//
$judul = produk()['judul'];
$produk = produk()['produk'];

//---- Inisiasi data-url untuk pencarian ----//
$dataUrl = "produk";

//---- Pengecekkan Hapus Data ----//
require 'template_admin/header.php';

?>
<div class="produk my-2 py-2 bg-primary text-light ">
    <?php if (isset($_GET['pesan'])) : ?>
        <div id="sukses" class="<?= $_GET['pesan'] ?>"></div>
    <?php endif; ?>

    <div class="pesan"></div>
    <div class="judul my-3 mx-5 text-uppercase d-flex justify-content-between">
        <h5>Produk</h5>
        <a href="<?= url ?>admin/tambahProduk.php" class="btn btn-sm btn-light mr-4">Tambah Produk</a>
    </div>
    <ul class="list-group text-dark">
        <?php foreach ($produk as $key => $value) : ?>
            <li class="list-group-item d-flex">
                <strong class=""><?= $key + 1 . "." ?></strong>
                <span class="col"><a href="<?= url ?>admin/detailProduk.php/?id=<?= $value->id_produk ?>" class="text-decoration-none" style="cursor: pointer"><?= $value->nama ?></a></span>
                <span class="col"><?= "Rp" . number_format($value->harga, 0) ?></span>
                <span class="col"><?= $value->kategori ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
    <table class="produk table table-striped ml-5 table-light ">
        <?php if (isset($_GET['message'])) : ?>
            <div class="pesan" data-pesan="<?= $_GET['message'] ?>"></div>
        <?php endif; ?>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Gambar</th>
                <th scope="col">Nama</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
                <th scope="col">Kategori</th>
                <th scope="col" class="text-center px-0">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produk as $key => $value) : ?>
                <tr>
                    <th scope="row"><?= $key + 1 ?></th>
                    <td>
                        <img src="<?= url . 'assets/images/produk/' . $value->gambar ?>" style="width: 80px" alt="">
                    </td>
                    <td><?= $value->nama ?></td>
                    <td>Rp<?= number_format($value->harga, 0) ?></td>
                    <td><?= $value->stok ?></td>
                    <td><?= $value->kategori ?></td>
                    <td class="text-center px-0 ">
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="<?= url ?>admin/detailProduk.php/?id=<?= $value->id_produk ?>" class="btn btn-sm btn-info">Detail</a>
                            <form action="<?= url ?>admin/produk.php/?id=<?= $value->id_produk ?>" method="POST">
                                <button class="hapus btn btn-sm btn-danger ml-2" name="hapus">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require 'template_admin/footer.php' ?>