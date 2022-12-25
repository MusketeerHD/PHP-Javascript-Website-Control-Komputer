<?php
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= url ?>assets/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= url ?>assets/font-awesome/css/font-awesome.min.css" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= url ?>assets/css/custom.css" crossorigin="anonymous">

    <title><?= $judul ?></title>
</head>

<body>

    <?php if (isset($_SESSION['pesan'])) : ?>
        <div id="pesan" data-pesan="<?= $_SESSION['pesan'] ?>"></div>
    <?php endif; ?>
    <?php unset($_SESSION['pesan']) ?>
    <?php require 'sidebar.php' ?>

    <div class="content">
        <div class="topbar bg-primary py-2">
            <nav class="row navbar ">
                <div class="col form-inline">
                    <input id="input-cari" data-url="<?= $dataUrl ?>" class="form-control mr-sm-2" type="search" placeholder="Cari sekarang" name="cari">
                </div>
            </nav>
        </div>