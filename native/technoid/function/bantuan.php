<?php

/*
---------------------------------------------------------
|   Menambahkan validasi kesetiap form                  |
--------------------------------------------------------- 
*/
function _validation($data)
{
    //membuat penyimapanan data semetara agar Inputan yang diketikkan tidak hilang,
    //ketika validasi ada yang gagal
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['harga'] = $data['harga'];
    $_SESSION['stok'] = $data['stok'];
    $_SESSION['deskripsi'] = $data['deskripsi'];

    if (empty($data['nama'])) {
        $pesan = ['pesan' => 'Masukkan nama dengan benar',];
        return $pesan;
    }
    if (empty($data['harga'])) {
        $pesan = ['pesan' => 'Masukkan nilai harga dengan benar',];
        return $pesan;
    }
    if ($data['kategori'] == "--Pilih--") {
        $pesan = ['pesan' => 'Pilih kategori produk anda',];
        return $pesan;
    }
    if (empty($data['stok'])) {
        $pesan = ['pesan' => 'Masukkan nilai stok dengan benar',];
        return $pesan;
    }
    if (empty($data['deskripsi'])) {
        $pesan = ['pesan' => 'Deskripsi wajib diisi',];
        return $pesan;
    }
    if ($data['gambar']['error'] != 4) {
        if ($data['gambar']['type'] == "image/jpg" || $data['gambar']['type'] == "image/jpeg" || $data['gambar']['type'] == "image/png") {
            return true;
        }
        $pesan = ['pesan' => 'Pilih ekstensi gambar ( JPEG, JPG, PNG ) ',];
        return $pesan;
    }
    $pesan = ['pesan' => 'Pilih gambar yang sesuai',];
    return $pesan;
}


function _hapusSession()
{
    //ketika data lolos dari validasi maka session akan dihapus
    if (isset($_SESSION['nama'])) {
        unset($_SESSION['nama']);
    }
    if (isset($_SESSION['harga'])) {
        unset($_SESSION['harga']);
    }
    if (isset($_SESSION['stok'])) {
        unset($_SESSION['stok']);
    }
    if (isset($_SESSION['deskripsi'])) {
        unset($_SESSION['deskripsi']);
    }
}

//Cek apa user telah Login
function cekLogin()
{

    if (isset($_SESSION['email'])) {
        return true;
    }
    return false;
}
function cekLoginAdmin()
{

    if (isset($_SESSION['email'])) {
        if ($_SESSION['role'] == 1) {
            return true;
        }
    }
    return false;
}
