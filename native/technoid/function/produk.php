<?php
require 'koneksi.php';
require 'bantuan.php';
require 'cart.php';

function produk()
{

    global $konek;

    $pd = mysqli_query($konek, "SELECT * FROM produk ORDER BY id_produk DESC  ");
    $produks = [];
    while ($produk = mysqli_fetch_object($pd)) {
        $produks[] = $produk;
    }
    $data = [
        'judul' => 'Catri produk sesukamu di TechnoID',
        'produk' => $produks,
    ];
    return $data;
}

function kategoriProduk($data)
{
    global $konek;

    $pd = mysqli_query($konek, "SELECT * FROM produk WHERE kategori='$data' ORDER BY id_produk DESC ");
    $produks = [];
    while ($produk = mysqli_fetch_object($pd)) {
        $produks[] = $produk;
    }
    return $produks;
}

function cariproduk($data)
{
    global $konek;

    $pd = mysqli_query($konek, "SELECT * FROM produk WHERE nama LIKE '%$data%' OR kategori LIKE '%$data%' OR deskripsi LIKE '%$data%' ORDER BY nama DESC ");
    $produks = [];
    while ($produk = mysqli_fetch_object($pd)) {
        $produks[] = $produk;
    }
    return $produks;
}
