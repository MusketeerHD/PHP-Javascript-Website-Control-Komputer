<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="float-right mr-2">&times;</span>
            </button>
            <h4 class="modal-title text-center">MASUK</h4>
            <div class="modal-body">
                <form class="w-75 py-4 m-auto" action="" method="POST">
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control" id="Email" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group ">
                        <label for="password">Kata Sandi</label>
                        <div class="input-group">
                            <input type="password" class="form-control border-right-0" id="password" autocomplete="off">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-left-0" id="btn-pwd" style="cursor: pointer"><i id="eye" class="fa fa-eye"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Ingat Saya</label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-100">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<footer>
    <div class="text-center py-3 bg-secondary">
        <span class="text-light ">&copy Copyright | <?= author . " (" . date('Y') . ")" ?></span>
    </div>
</footer>




<!-- Cek Pembayaran -->
<?php if (isset($transaksi)) : ?>
    <?php foreach ($transaksi as $key => $value) : ?>
        <div class="modal fade" id="cek-bayar<?= $value->id_pesan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>ID Pesan : <?= $value->id_pesan ?> | Penerima : <?= $value->penerima ?> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <?php
                    $cek = cekBayar($value->id_pesan);
                    ?>

                    <form method="POST" action="">
                        <div class="modal-body">
                            <input type="hidden" name="idpesan" value="<?= $value->id_pesan ?>">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input class="form-control" type="text" name="nama" value="<?= $cek->nama ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <input class="form-control" type="text" value="Rp<?= number_format($cek->nominal, 0) ?>" readonly>
                            </div>
                            <div class="form-group text-center">
                                <img src="<?= url ?>assets/images/bayar/<?= $cek->gambar ?>" class="  w-50" alt="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" name="verifi" class="btn btn-sm btn-primary">Verifikasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="detail<?= $value->id_pesan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5>ID Pesan : <?= $value->id_pesan ?> | Penerima : <?= $value->penerima ?> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" style="width: 10%">Gambar</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kuantiti</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id = $value->id_pesan;
                                $trDetail = transaksiDetail($id)['detail'];

                                foreach ($trDetail as $key => $detail) : ?>
                                    <tr class="border-bottom">
                                        <th scope="row"><?= $key + 1 ?></th>
                                        <td><img src="<?= url ?>assets/images/produk/<?= $detail->gambar ?>" class="w-100" alt=""></td>
                                        <td><?= $detail->nama ?></td>
                                        <td><?= $detail->kuantiti ?></td>
                                        <td>Rp<?= number_format($detail->total, 0) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-uppercase">Status : <?= $value->keterangan ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- Modal detail Pengguna -->
<?php if (isset($pengguna)) : ?>
    <?php foreach ($pengguna as $key => $value) : ?>
        <div class="modal fade" id="detail<?= $value->id_user ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5>ID User : <?= $value->id_user ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                <img src="<?= url ?>assets/images/user/<?= $value->image ?>" alt="">
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <h5 class="font-weight-bold">Nama</h5>
                                    <?= $value->nama ?>
                                </li>
                                <li class="list-group-item">
                                    <h5 class="font-weight-bold">Email</h5><?= $value->email ?>
                                </li>
                                <li class="list-group-item">
                                    <h5 class="font-weight-bold">Kata Sandi</h5><?= $value->sandi ?>
                                </li>
                                <li class="list-group-item">
                                    <h5 class="font-weight-bold">Bergabung pada</h5><?= $value->createat ?>
                                </li>
                                <li class="list-group-item">
                                    <h5 class="font-weight-bold">Di ubah</h5><?= $value->updateat ?>
                                </li>
                                <li class="list-group-item">
                                    <form action="" method="post">
                                        <input type="hidden" name="iduser" value="<?= $value->id_user ?>">
                                        <button type="submit" name="hapus" class="btn btn-sm btn-primary">Hapus</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>]
    <?php endforeach; ?>
<?php endif; ?>




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?= url; ?>assets/js/jquery-3.5.1.js" crossorigin="anonymous"></script>
<script src="<?= url; ?>assets/js/pooper.js" crossorigin="anonymous"></script>
<script src="<?= url; ?>assets/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="<?= url ?>assets/js/sweetalert2.all.js" crossorigin="anonymous"></script>

<!-- Custom Javascript -->
<script src="<?= url; ?>assets/js/custom.js" crossorigin="anonymous"></script>

</body>

</html>