<?php
require 'koneksi.php';

function transaksi()
{
    $data = [
        'judul' => 'CekOut keranjangmu sekarang',
    ];
    return $data;
}

function tambahTransaksi($post)
{
    global $konek;

    $id_pesan = rand();

    $id_user = $_SESSION['iduser'];
    $pengirim = $post['pengirim'];
    $penerima = $post['penerima'];
    $alamat = $post['alamat'];
    $telepon = $post['telepon'];
    $email = $post['email'];
    $kuantiti_total = $post['kuantiti_total'];
    $total_akhir = $post['subtotal'];
    $pembayaran = 0;
    $id_status = 0;
    $pesan = date('y-m-d h:i:s');


    mysqli_query($konek, "INSERT INTO transaksi VALUES(
        '', '$id_pesan','$id_user',  '$pengirim', '$penerima', '$alamat', '$telepon', '$email', '$kuantiti_total', '$total_akhir', '$pembayaran', '$id_status', '$pesan', '', '' 
        )");

    $carts = ambilCart()['carts'];
    $i = 1;
    $j = 1;
    foreach ($carts as $value) {
        $kuantiti = $post['kuantiti' . $i++];
        $id_produk = $post['id_produk' . $j++];
        $total = $value->total;
        mysqli_query($konek, "INSERT INTO transaksi_detail VALUES(
            '','$id_pesan', '$id_produk', '$kuantiti', '$total'
        )");
    }

    $carts = ambilCart()['carts'];
    $i = 1;
    $j = 1;
    foreach ($carts as $value) {
        $kuantiti = $post['kuantiti' . $i++];
        $id_produk = $post['id_produk' . $j++];
        $jual = mysqli_query($konek, "SELECT * FROM penjualan WHERE id_produk='$id_produk'");
        $ambilJual = $jual->fetch_object();

        if (mysqli_num_rows($jual) === 0) {
            mysqli_query($konek, "INSERT INTO penjualan VALUES(
                '','$id_produk', '$kuantiti'
            )");
        } else {
            $jual = $ambilJual->jual + $kuantiti;
            mysqli_query($konek, "UPDATE penjualan SET jual='$jual'");
        }
    }

    $carts = ambilCart()['carts'];
    $i = 1;
    $j = 1;
    foreach ($carts as $value) {
        $kuantiti = $post['kuantiti' . $i++];
        $id_produk = $post['id_produk' . $j++];
        $stok = mysqli_query($konek, "SELECT * FROM produk WHERE id_produk='$id_produk'");
        $ambilStok = $stok->fetch_assoc();

        $stokBaru = $ambilStok['stok'] - $kuantiti;
        if (mysqli_num_rows($stok) > 0) {
            mysqli_query($konek, "UPDATE produk SET stok='$stokBaru' WHERE id_produk='$id_produk'");
        }
    }
    bersihkanCart();

    $_SESSION['sukses'] = "Transaksi berhasil. SIlahkan melakukan Pembayaran";
    return;
}


function ambilTransaksi()
{
    global $konek;

    $id_user = $_SESSION['iduser'];
    $result = mysqli_query($konek, "SELECT * FROM transaksi JOIN status ON status.id_status = transaksi.id_status  WHERE id_user='$id_user'");
    $trans = [];
    while ($tran = mysqli_fetch_object($result)) {
        $trans[] = $tran;
    }

    $data = [
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

function bayar($post)
{

    global $konek;

    var_dump($img = $_FILES['gambar']);
    $imgname = rand() . "-" . date('Y-m-d-h-i-s-') . $img['name'];

    if ($img['error'] == 4) {
        $_SESSION['pesan'] = 'Anda belum memasukkan bukti pembayaran';
        return header('location:' . url . 'user/profil.php');
    } elseif ($img['type'] == 'image/jpg' || $img['type'] == 'image/jpeg' || $img['type'] == 'image/png') {
        move_uploaded_file($img['tmp_name'], '../assets/images/bayar/' . $imgname);
    } else {
        $_SESSION['pesan'] = 'Pilih gambar dengan ekstensi JPG, JPEG, PNG!!';
        return header('location:' . url . 'user/profil.php');
    }

    $nama = $post['nama'];
    $id_pesan = $post['idpesan'];
    $nominal = $post['nominal'];
    $gambar = $imgname;

    mysqli_query($konek, "INSERT INTO pembayaran VALUES('','$id_pesan','$nama','$nominal','$gambar')");

    var_dump(mysqli_query($konek, "UPDATE transaksi SET pembayaran='1' WHERE id_pesan='$id_pesan'"));
    return header('location:' . url . 'user/profil.php');
}

function terimaTransaksi($id)
{
    global $konek;
    $id = $id['idpesan'];
    mysqli_query($konek, "UPDATE transaksi SET id_status='3' WHERE id_pesan='$id'");
    return header('location:' . url . 'user/profil.php');
}
