<?php
require 'koneksi.php';

function tambahKontak($post)
{

    global $konek;

    $nama = $post['nama'];
    $email = $post['email'];
    $tentang = $post['tentang'];
    $pesan = $post['pesan'];
    $tgl = date('Y-m-d h:i:s');

    var_dump(mysqli_query($konek, "INSERT INTO kontak VALUES('', '$nama', '$email', '$tentang', '$pesan','$tgl')"));

    return header('location:' . url . 'user/kontak.php');
}

function ambilKontak()
{
    global $konek;

    $kontak = [];
    $produk = mysqli_query($konek, "SELECT * FROM kontak");

    while ($hasil = mysqli_fetch_assoc($produk)) {
        $kontak[] = $hasil;
    }
    $data = [
        'judul' => 'Kontak Kami',
        'kontak' => $kontak,
    ];
    return $data;
}
