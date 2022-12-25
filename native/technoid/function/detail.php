<?php
require 'koneksi.php';
require 'bantuan.php';
require 'cart.php';

function detail($id)
{
    global $konek;

    $hasil =  mysqli_query($konek, "SELECT * FROM produk WHERE id_produk = '$id'");

    $data = [
        'produk' => $produk = mysqli_fetch_object($hasil),
        'judul' => $produk->nama,
    ];
    return $data;
}

function histori($get)
{
    global $konek;

    //Menangkap data Request POST dan menyimpan di sebuah variabel
    $id_produk  = $get;
    $times      = date('y-m-d');

       
    mysqli_query($konek, "INSERT INTO histori VALUES(
        '','$times','$id_produk')");
}
