<?php
session_start();
require '../function/koneksi.php';
require '../function/auth.php';

$judul = 'Daftarkan akun anda dan bergabung dengan komunitas';

if (isset($_POST['login'])) {
    masuk($_POST);
}

require 'templates/header.php';
?>
<div class="row pt-5">
    <div class="col">
        <div class="row mt-5">
            <div class="col border-bottom">
                <h4 class="text-center">DAFTAR</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <img src="<?= url ?>assets/images/pages/masuk.png" class="w-100" alt="">
            </div>
            <div class="col-md bg-light my-3">

                <form class="w-75 py-4 m-auto" action="" method="POST">
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control" placeholder="Email anda" id="Email" required name="email">
                    </div>
                    <div class="form-group ">
                        <label for="password">Sandi</label>
                        <div class="input-group">
                            <input type="password" class="form-control border-right-0" placeholder="Sandi anda" id="password" required name="sandi" autocomplete="off">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-left-0" id="btn-pwd" style="cursor: pointer"><i id="eye" class="fa fa-eye"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button name="login" type="submit" class="btn btn-primary w-100">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'templates/footer.php'; ?>