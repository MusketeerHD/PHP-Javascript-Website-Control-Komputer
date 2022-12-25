<?php
session_start();
require 'koneksi.php';
require 'auth.php';
require 'bantuan.php';
require 'cart.php';


function home()
{
    global $konek;

    $pd = mysqli_query($konek, "SELECT * FROM produk ORDER BY id_produk DESC LIMIT 10");
    $produks = [];
    while ($produk = mysqli_fetch_object($pd)) {
        $produks[] = $produk;
    }
    $data = [
        'judul' => 'Selamat Datang di TechnoId',
        'produk' => $produks,
    ];
    return $data;
}

function recomend()
{
    global $konek;

    $pds = mysqli_query($konek, "SELECT histori.id_produk, produk.* FROM histori left join produk on histori.id_produk=produk.id_produk ORDER BY produk.id_produk DESC LIMIT 10");
    $produks = [];
    while ($histori = mysqli_fetch_object($pds)) {
        $historis[] = $histori;
    }
    $data = [
        'judul' => 'Selamat Datang di TechnoId',
        'histori' => $historis,
    ];
    return $data;
}