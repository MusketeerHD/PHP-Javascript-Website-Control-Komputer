<?php
function tambahCart($post)
{

    global $konek;

    $id_user = $_SESSION['iduser'];
    $id_produk = $post['id_produk'];
    $nama = $post['nama'];
    $harga = $post['harga'];
    $kuantiti = $post['kuantiti'];
    $gambar = $post['gambar'];
    $kategori = $post['kategori'];
    $total = $harga * $kuantiti;


    var_dump($cek = mysqli_query($konek, "SELECT * FROM cart WHERE id_produk='$id_produk'"));
    $cekKuantiti = mysqli_fetch_assoc($cek);
    $kuantitiBaru = ($cekKuantiti['kuantiti'] + $kuantiti);
    if (mysqli_num_rows($cek) === 0) {
        mysqli_query($konek, "INSERT INTO cart VALUES(
            '', '$id_user', '$id_produk', '$nama', '$harga', '$kuantiti', '$gambar', '$kategori', '$total'
            )");
    } else if (mysqli_num_rows($cek) > 0) {
        mysqli_query($konek, "UPDATE cart SET kuantiti='$kuantitiBaru' WHERE id_produk='$id_produk'");
    }
    $_SESSION['sukses'] = "Barang berhasil ditambahkan keranjang";
    return;
}

function ambilCart()
{
    global $konek;

    $id = $_SESSION['iduser'];
    $carts = [];
    $produk = mysqli_query($konek, "SELECT * FROM cart WHERE id_user='$id'");
    $subtotal = mysqli_query($konek, "SELECT SUM(total) as subtotal FROM cart WHERE id_user='$id'");
    $kuantiti = mysqli_query($konek, "SELECT SUM(kuantiti) as kuantiti FROM cart WHERE id_user='$id'");

    while ($hasil = mysqli_fetch_object($produk)) {
        $carts[] = $hasil;
    }
    $data = [
        'carts' => $carts,
        'subtotal' => mysqli_fetch_object($subtotal),
        'kuantiti' => mysqli_fetch_object($kuantiti),
    ];
    return $data;
}

function ubahCart($post)
{
    global $konek;

    $id_cart = $post['idCart'];
    $kuantiti = $post['kuantiti'];
    $total = $post['harga'] * $kuantiti;

    mysqli_query($konek, "UPDATE cart SET kuantiti='$kuantiti', total='$total' WHERE id_cart='$id_cart'");

    $_SESSION['sukses'] = "Barang berhasil diubah";
    return;
}

function hapusCart($post)
{
    global $konek;

    $id_cart = $post['idCart'];

    mysqli_query($konek, "DELETE FROM cart WHERE id_cart='$id_cart'");

    $_SESSION['sukses'] = "Barang berhasil dihapus dari keranjang";
    return;
}

function bersihkanCart()
{
    global $konek;

    $id_user = $_SESSION['iduser'];

    mysqli_query($konek, "DELETE FROM cart WHERE id_user='$id_user'");

    $_SESSION['sukses'] = "Keranjang berhasil dibersihkan";
    return;
}
