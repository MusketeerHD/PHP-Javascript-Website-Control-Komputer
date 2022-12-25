<?php
session_start();
require 'auth.php';
function profil()
{
    global $konek;

    $id = $_SESSION['iduser'];
    var_dump($pengguna = mysqli_query($konek, "SELECT * FROM users WHERE id_user = '$id'"));

    $data = [
        'judul' =>  $_SESSION['nama'],
        'pengguna' => mysqli_fetch_object($pengguna),
    ];
    return $data;
}
