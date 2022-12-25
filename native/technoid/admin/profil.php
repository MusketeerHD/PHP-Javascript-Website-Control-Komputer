<?php
require '../function/admin.php';

if (cekLoginAdmin() === false) {
    $_SESSION['pesan'] = "Anda belum masuk!! Silahkan masuk terlebih dahulu!";
    header('location:' . url . 'user/masuk.php');
}

$judul = profil($_GET['id'])['judul'];
$user = profil($_GET['id'])['user'];

require 'template_admin/header.php';
?>
<div class="row">
    <div class="col-4 text-center">
        <img class="w-50" src="<?= url ?>assets/images/user/<?= $user->image ?>" alt="">
    </div>
    <div class="col-8">
        <ul class="list-group list-group-flush w-50">
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
</div>

<?php require 'template_admin/footer.php'; ?>