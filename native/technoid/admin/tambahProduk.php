<?php
require '../function/admin.php';
if (cekLoginAdmin() === false) {
    $_SESSION['pesan'] = "Anda belum masuk!! Silahkan masuk terlebih dahulu!";
    header('location:' . url . 'user/masuk.php');
}

if (isset($_POST['simpan'])) {
    tambahProduk($_POST);
}

$judul = 'Tambah Produk | Admin';
require 'template_admin/header.php';
?>

<div>
    <?php if (isset($_GET['pesan'])) : ?>
        <div id="pesan" class="<?= $_GET['pesan'] ?>"></div>
    <?php endif; ?>
    <div class="card w-100 text-dark ">
        <div class="card-body border-top">
            <h5 class="card-title text-uppercase">tambah Data</h5>
        </div>
        <form class="ml-3" method="POST" action="" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group mx-2 col-sm-5 ">
                    <label for="nama">Nama</label>
                    <input class="form-control" type="text" name="nama" id="nama" value="<?= (isset($_SESSION['nama'])) ? $_SESSION['nama'] :  "" ?>">
                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                </div>
                <div class="form-group mx-2 col-sm-5 ">
                    <label for="harga">harga</label>
                    <input class="form-control" type="number" name="harga" id="harga" value="<?= (isset($_SESSION['harga'])) ? $_SESSION['harga'] :  "" ?>">
                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                </div>
            </div>
            <div class="row">
                <div class="form-group mx-2 col-sm-5 ">
                    <label for="kategori">kategori</label>
                    <select class="form-control" name="kategori" id="kategori">
                        <option>--Pilih--</option>
                        <option value="Ponsel">Ponsel</option>
                        <option value="Laptop">Laptop</option>
                        <option value="Komputer">Komputer</option>
                    </select>
                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                </div>
                <div class="form-group mx-2 col-sm-5 ">
                    <label for="stok">stok</label>
                    <input class="form-control" type="number" name="stok" id="stok" value="<?= (isset($_SESSION['stok'])) ? $_SESSION['stok'] :  "" ?>">
                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                </div>
            </div>
            <div class="row">
                <div class="form-group mx-2 col-sm-5 ">
                    <label for="deskripsi">deskripsi</label>
                    <textarea class="form-control" type="text" name="deskripsi" id="deskripsi"><?= (isset($_SESSION['deskripsi'])) ? $_SESSION['deskripsi'] :  "" ?></textarea>
                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group mx-2 col-sm-3 ">
                    <label for="gambar">gambar</label>
                    <input class="form-control" type="file" name="gambar" id="gambar">
                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                </div>
                <div class="ol-4">

                </div>
            </div>
            <div class=" text-center my-3">
                <button type="submit" name="simpan" class="btn btn-sm btn-primary w-25" href="#" class="card-link">Simpan</button>
                <a href="<?= url ?>admin/detailProduk.php/?id=<?= $produk['produk']->id_produk ?>" class="btn btn-sm btn-danger w-25" class="card-link">Batal</a>
            </div>
        </form>
    </div>
</div>

<?php require 'template_admin/footer.php' ?>