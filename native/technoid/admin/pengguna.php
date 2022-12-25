<?php
require '../function/admin.php';
if (cekLoginAdmin() === false) {
    $_SESSION['pesan'] = "Anda belum masuk!! Silahkan masuk terlebih dahulu!";
    header('location:' . url . 'user/masuk.php');
}

$judul = pengguna()['judul'];
$pengguna = pengguna()['pengguna'];

if (isset($_GET['detail'])) {
    detailPengguna($_GET['id']);
}

if (isset($_POST['hapus'])) {
    hapusPengguna($_POST['iduser']);
}

//pencarian
$dataUrl = "pengguna";

require 'template_admin/header.php';
?>

<div class="row py-3 px-3 bg-light justify-content-around">
    <div class="col-sm">
        <h5 id="judul" class="text-uppsercase ">pengguna</h5>
    </div>
    <div class="col-sm">
        <a href="<?= url ?>admin/cetakPengguna.php" class="d-flex justify-content-end text-decoration-none"><i class=" fa fa-download"></i>
            <h6 class="mx-3">Cetak Data Pengguna</h6>
        </a>
    </div>
</div>

<table class="pengguna table">
    <thead>
        <tr>
            <th scope="col" style="width: 5%">#</th>
            <th scope="col" style="width: 5%">ID</th>
            <th scope="col" style="width: 10%">GAMBAR</th>
            <th scope="col">NAMA</th>
            <th scope="col">EMAIL</th>
            <th scope="col">AKSI</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pengguna as $key => $value) : ?>
            <tr>
                <th scope="row"><?= $key + 1 ?></th>
                <td><?= $value->id_user ?></td>
                <td>
                    <img src="<?= url ?>assets/images/user/<?= $value->image ?>" class="w-75 bg-light" alt="">
                </td>
                <td><?= $value->nama ?></td>
                <td><?= $value->email ?></td>
                <td>
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detail<?= $value->id_user ?>">Detail</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require 'template_admin/footer.php' ?>