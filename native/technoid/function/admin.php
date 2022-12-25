<?php
session_start();
require 'koneksi.php';
require 'bantuan.php';


function home()
{
    global $konek;


    $barang = mysqli_query($konek, "SELECT * FROM produk");
    $jual = mysqli_query($konek, "SELECT SUM(jual) as jual FROM penjualan");
    $akun = mysqli_query($konek, "SELECT * FROM users WHERE role='2'");
    $trans = mysqli_query($konek, "SELECT * FROM transaksi JOIN status ON status.id_status=transaksi.id_status WHERE transaksi.id_status < 2 ORDER BY id DESC LIMIT 7 ");
    $tran = [];
    while ($tr = mysqli_fetch_object($trans)) {
        $tran[] = $tr;
    }
    $data = [
        'judul'     => 'Beranda',
        'produk'    => mysqli_fetch_object($barang),
        'jmlPd'     => mysqli_num_rows($barang),
        'akun'     => mysqli_num_rows($akun),
        'jual'     => mysqli_fetch_object($jual),
        'trans'     => $tran,
    ];
    return $data;
}

/*
---------------------------------------------------------                  
|                    CRUD PRODUK                        |
|   Berisi fungsi - fungsi untuk mengelola data produk  |    
---------------------------------------------------------
*/
function produk()
{
    global $konek;

    $kueri  = mysqli_query($konek, "SELECT * FROM produk ORDER BY id_produk DESC");
    $produk = [];
    while ($pd = mysqli_fetch_object($kueri)) {
        $produk[]   = $pd;
    }
    $data = [
        'judul'     => "Halaman Admin | Produk",
        'produk'    => $produk,
    ];
    return $data;
}

/*
-----------------------------------------------------
|   Menghapus data produk setelah menerima ID       | 
|   Request GET kemudian akan di redirect ke halaman|
|   Produkphp                                       |
-----------------------------------------------------
*/
function hapusProduk($id)
{
    global $konek;
    mysqli_query($konek, "DELETE FROM produk WHERE id_produk='$id'");
    if (mysqli_affected_rows($konek) > 0) {
        $berhasil = "Data telah dihapus";
        return header('location:../produk.php/?pesan=' . $berhasil);
    }
    return false;
}

/*
-----------------------------------------------------
|   Mengambil data produk sesuai dengan ID          | 
|   dan menyimpannya ke suatu Array Objek           |
-----------------------------------------------------
*/
function detailProduk($id)
{
    global $konek;

    $kueri = mysqli_query($konek, "SELECT * FROM produk WHERE id_produk='$id'");
    $data = [
        'true'      => true,
        'judul'     => 'Detail Barang | Halaman Admin',
        'produk'    => mysqli_fetch_object($kueri),
    ];
    return $data;
}

/*
-----------------------------------------------------
|   menyimpan data request post ke dalam array yang | 
|   selanjutnya akan dikirimkan ke fungsivalidasi   |
-----------------------------------------------------
*/
function tambahProduk($post)
{
    global $konek;

    //Menangkap data Request POST dan menyimpan di sebuah variabel
    $img        = $_FILES['gambar'];
    $namaBaru   = date('yymmdd') . time() . str_replace(' ', '', $img['name']);
    $nama       = htmlspecialchars($post['nama']);
    $harga      = htmlspecialchars($post['harga']);
    $stok       = htmlspecialchars($post['stok']);
    $gambar     = $namaBaru;
    $kategori   = htmlspecialchars($post['kategori']);
    $deskripsi  = htmlspecialchars($post['deskripsi']);
    $create     = date('y-m-d h:i:s');

    //menyimpan data request post ke dalam array yang selanjutnya akan dikirimkan ke fungsi validasi  
    $data = [
        'nama'      => $nama,
        'harga'     => $harga,
        'stok'      => $stok,
        'gambar'    => $img,
        'kategori'  => $kategori,
        'deskripsi' => $deskripsi
    ];

    //Mengecek apakah data yang dikirimkan lolos di fungsi Validasi
    if (isset(_validation($data)['pesan'])) {
        header('location:' . url . 'admin/tambahProduk.php/?pesan=' . _validation($data)['pesan']);
        die;
    }
    //menghapus session untuk menyimpan data form sementara 
    _hapusSession();

    mysqli_query($konek, "INSERT INTO produk VALUES(
        '', '$nama', '$harga', '$stok', '$gambar' ,'$kategori', '$deskripsi','$create',''
    )");
    if (mysqli_affected_rows($konek)) {
        move_uploaded_file($img['tmp_name'], '../assets/images/produk/' . $namaBaru);
        return header('location:' . url . 'admin/produk.php/?pesan=Data berhasil ditambahkan');
    } else {
        echo "errror";
        die;
    }
}

/*
-----------------------------------------------------
|   menyimpan data ID dan request POST              |
|   dan mengambil data lama di database dan meng    |
|   Updatenya setelah lolos validasi                |
-----------------------------------------------------
*/
function ubahProduk($id, $post)
{
    global $konek;

    //mengambil data lama berdasarkan id yang diterima
    $pd = mysqli_fetch_object(mysqli_query($konek, "SELECT * FROM produk WHERE id_produk='$id'"));

    //pengkondisdian apakah gambar berubah atau tetap, jika gambar berubah maka, 
    //akan membuat nama baru dan menghapus gambar lama di direktorinya,
    //namun jika gambar tidak berubah akan menggunakan nama lama
    $img = $_FILES['gambar'];
    if ($img['error'] === 4) {
        $gambar     = $pd->gambar;
        $newImage   = ['error' => 0, 'type' => 'image/jpg'];
    } else {
        $namaBaru   = date('yymmdd') . time() . str_replace(' ', '', $img['name']);
        $gambar     = $namaBaru;
        $newImage   = $img;

        move_uploaded_file($img['tmp_name'], '../assets/images/produk/' . $namaBaru);
        unlink('../assets/images/produk/' . $pd->gambar);
    }


    //sama seperti fungsi tambah data
    $nama       = htmlspecialchars($post['nama']);
    $harga      = htmlspecialchars($post['harga']);
    $stok       = htmlspecialchars($post['stok']);
    $kategori   = htmlspecialchars($post['kategori']);
    $deskripsi  = htmlspecialchars($post['deskripsi']);
    $create     = $pd->createat;
    $update     = date('y-m-d h:i:s');

    $data = [
        'nama'      => $nama,
        'harga'     => $harga,
        'stok'      => $stok,
        'gambar'    => $newImage,
        'kategori'  => $kategori,
        'deskripsi' => $deskripsi
    ];

    //-----------------------------------------------------------------
    if (isset(_validation($data)['pesan'])) {
        $_SESSION['pesan'] = _validation($data)['pesan'];
        return header('location:' . url . 'admin/detailProduk.php/?id=' . $id);
    }
    _hapusSession();

    $sql = mysqli_query($konek, "UPDATE produk SET nama='$nama', harga='$harga', stok='$stok', gambar='$gambar', kategori='$kategori', deskripsi='$deskripsi',createat='$create', updateat='$update' WHERE id_produk = '$id' ");
    if ($sql > 0) {
        return header('location:' . url . 'admin/produk.php/?pesan=Data berhasil Diubah');
    }

    return "Gagal Mengubah data";
}


/*-------------------------------------------------------                  
|                 TANSAKSI DAN BAYAR                    |
| Berisi fungsi - fungsi untuk mengelola data transaksi |    
---------------------------------------------------------*/
function ambilTransaksi()
{
    global $konek;

    $result = mysqli_query($konek, "SELECT * FROM transaksi JOIN status ON status.id_status = transaksi.id_status WHERE transaksi.id_status != '3' ");
    $trans = [];
    while ($tran = mysqli_fetch_object($result)) {
        $trans[] = $tran;
    }

    $data = [
        'judul' => "Transaki | Admin",
        'trans' => $trans,
    ];

    return $data;
}

function transaksiDetail($id)
{
    global $konek;
    $id_pesan = $id;
    $result = mysqli_query($konek, "SELECT * FROM transaksi_detail JOIN produk ON produk.id_produk = transaksi_detail.id_produk  WHERE id_pesan='$id_pesan'");
    $detail = [];
    while ($tran = mysqli_fetch_object($result)) {
        $detail[] = $tran;
    }

    $data = [
        'detail' => $detail,
    ];

    return $data;
}

function verifiTransaksi($id)
{
    global $konek;

    $id_pesan = $id['idpesan'];
    mysqli_query($konek, "UPDATE transaksi SET id_status='1' WHERE id_pesan = '$id_pesan' ");

    return header('location:' . url . 'admin/transaksi.php');
}

function kirimTransaksi($id)
{
    global $konek;

    $tgl = date('y-m-d h:i:s');
    $id_pesan = $id['idpesan'];
    mysqli_query($konek, "UPDATE transaksi SET id_status='2', kirim_at='$tgl' WHERE id_pesan = '$id_pesan' ");

    return header('location:' . url . 'admin/transaksi.php');
}

function cekBayar($id)
{
    global $konek;

    $data = mysqli_query($konek, "SELECT * FROM pembayaran WHERE id_pesan='$id'");

    return mysqli_fetch_object($data);
}

/*-------------------------------------------------------                  
|               DATA PENGGUNA TERDAFTAR                 |
| Berisi fungsi - fungsi untuk mengelola data pengguna  |    
---------------------------------------------------------*/
function pengguna()
{

    global $konek;

    $penggunas = [];
    $pengguna = mysqli_query($konek, "SELECT * FROM users ORDER BY id_user DESC");
    while ($p = $pengguna->fetch_object()) {
        $penggunas[] = $p;
    }

    $data = [
        'judul' => 'Data Pengguna | Admin',
        'pengguna' => $penggunas,
    ];

    return $data;
}

function detailPengguna($id)
{
}

function hapusPengguna($id)
{
    global $konek;

    mysqli_query($konek, "DELETE FROM  users WHERE id_user='$id'");
    return header('location:' . url . 'admin/pengguna.php');
}

function profil($id)
{
    global $konek;

    $data = mysqli_query($konek, "SELECT * FROM  users WHERE id_user='$id'");
    $data = [
        'judul' => 'Profil saya',
        'user' => mysqli_fetch_object($data)
    ];
    return $data;
}

