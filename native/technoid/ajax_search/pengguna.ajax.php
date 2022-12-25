<?php
require '../function/koneksi.php';
global $konek;

$keyword = $_GET['cari'];
$hasil = mysqli_query($konek, "SELECT * FROM users  WHERE nama LIKE'%$keyword%' OR email LIKE '%$keyword%' ");
$pengguna = [];
while ($pd = mysqli_fetch_object($hasil)) {
    $pengguna[] = $pd;
}

?>
<table class="pengguna table">
    <thead>
        <tr>
            <th scope="col" style="width: 5%">#</th>
            <th scope="col" style="width: 5%">ID</th>
            <th scope="col" style="width: 10%">GAMBAR</th>
            <th scope="col">NAMA</th>
            <th scope="col">EMAIL</th>
            <th scope="col">AKSI</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pengguna as $key => $value) : ?>
            <tr>
                <th scope="row"><?= $key + 1 ?></th>
                <td><?= $value->id_user ?></td>
                <td>
                    <img src="<?= url ?>assets/images/user/<?= $value->image ?>" class="w-75 bg-light" alt="">
                </td>
                <td><?= $value->nama ?></td>
                <td><?= $value->email ?></td>
                <td>
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detail<?= $value->id_user ?>">Detail</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>