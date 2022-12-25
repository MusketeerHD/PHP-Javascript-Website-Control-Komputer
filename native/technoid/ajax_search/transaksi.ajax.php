<?php
require '../function/koneksi.php';
global $konek;
if (isset($_GET['cari'])) {

    $keyword = $_GET['cari'];
    $hasil = mysqli_query($konek, "SELECT * FROM transaksi JOIN status ON status.id_status = transaksi.id_status WHERE id_pesan LIKE'%$keyword%' OR penerima LIKE '%$keyword%' OR pengirim LIKE '%$keyword%' OR keterangan LIKE '%$keyword%' ");
    $transaksi = [];
    while ($tr = mysqli_fetch_object($hasil)) {
        $transaksi[] = $tr;
    }
} else {
    $hasil = mysqli_query($konek, "SELECT * FROM transaksi JOIN status ON status.id_status = transaksi.id_status WHERE transaksi.id_status='3'");
    $transaksi = [];
    while ($tr = mysqli_fetch_object($hasil)) {
        $transaksi[] = $tr;
    }
}

?>
<table class="transaksi table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID PESAN</th>
            <th scope="col">PENERIMA</th>
            <th scope="col">PENGIRIM</th>
            <th scope="col">JUMLAH</th>
            <th scope="col">TOTAL HARGA</th>
            <th scope="col" class="text-center">STATUS</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transaksi as $key => $value) : ?>
            <tr>
                <th scope="row"><?= $key + 1 ?></th>
                <td><?= $value->id_pesan ?></td>
                <td><?= $value->penerima ?></td>
                <td><?= $value->pengirim ?></td>
                <td><?= $value->kuantiti_total ?></td>
                <td>Rp<?= number_format($value->total_akhir, 0) ?></td>
                <td class="text-center">
                    <?php if ($value->id_status == 0 && $value->pembayaran == 0) : ?>
                        <span class=" badge badge-warning">Menungggu pembayaran</span>
                    <?php elseif ($value->id_status == 0 && $value->pembayaran == 1) : ?>
                        <span class=" badge badge-warning">Verifikasi pembayaran</span>
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#cek-bayar<?= $value->id_pesan ?>">
                            Cek
                        </button>
                    <?php elseif ($value->id_status == 1 && $value->pembayaran == 1) : ?>
                        <form action="" method="post">
                            <input type="hidden" name="idpesan" value="<?= $value->id_pesan ?>">
                            <button name="kirim" class="btn btn-sm btn-primary">
                                Kirim
                            </button>
                        </form>
                    <?php elseif ($value->id_status == 2) : ?>
                        <span class=" badge badge-primary"><?= $value->keterangan ?></span>
                    <?php elseif ($value->id_status == 3) : ?>
                        <span class="badge badge-success"><?= $value->keterangan ?></span>
                    <?php endif; ?>
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detail<?= $value->id_pesan ?>">Detail</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>