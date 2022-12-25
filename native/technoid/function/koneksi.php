<?php

require '../config/config.php';
$konek = mysqli_connect(hostname, username, password, database);

if (mysqli_errno($konek)) {
    echo "Gagal koneksi ke database";
    exit;
}
