<?php
require '../function/koneksi.php';
global $konek;

$keyword = $_GET['cari'];
$hasil = mysqli_query($konek, "SELECT * FROM produk  WHERE nama LIKE'%$keyword%' OR kategori LIKE '%$keyword%' OR deskripsi ");
$produk = [];
while ($pd = mysqli_fetch_object($hasil)) {
    $produk[] = $pd;
}

?>
<table class="produk table table-striped ml-5 table-light ">
    <?php if (isset($_GET['message'])) : ?>
        <div class="pesan" data-pesan="<?= $_GET['message'] ?>"></div>
    <?php endif; ?>
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Gambar</th>
            <th scope="col">Nama</th>
            <th scope="col">Harga</th>
            <th scope="col">Kategori</th>
            <th scope="col" class="text-center px-0">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produk as $key => $value) : ?>
            <tr>
                <th scope="row"><?= $key + 1 ?></th>
                <td>
                    <img src="<?= url . 'assets/images/produk/' . $value->gambar ?>" style="width: 80px" alt="">
                </td>
                <td><?= $value->nama ?></td>
                <td><?= $value->harga ?></td>
                <td><?= $value->kategori ?></td>
                <td class="text-center px-0 ">
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="<?= url ?>admin/detailProduk.php/?id=<?= $value->id_produk ?>" class="btn btn-sm btn-info">Detail</a>
                        <form action="<?= url ?>admin/produk.php/?id=<?= $value->id_produk ?>" method="POST">
                            <button class="hapus btn btn-sm btn-danger ml-2" name="hapus">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>