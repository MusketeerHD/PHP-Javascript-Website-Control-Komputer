<?php

function masuk($post)
{
    global $konek;
    $email = $post['email'];
    $sandi = $post['sandi'];

    $kueri = mysqli_query($konek, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($kueri) > 0) {
        $data = mysqli_fetch_object($kueri);
        $verifikasi = password_verify($sandi, $data->sandi);
        if ($verifikasi === true) {
            $_SESSION['iduser'] = $data->id_user;
            $_SESSION['nama'] = $data->nama;
            $_SESSION['email'] = $data->email;
            $_SESSION['role'] = $data->role;
            $_SESSION['tglMasuk'] = date('y-m-d h:i:s');
            if ($data->role == 1) {
                header('location:' . url . 'admin');
            } else {
                header('location:' . url . 'user');
            }
        } else {
            $_SESSION['pesan'] = "Password yang anda masukkan tidak sesuai!";
        }
    } else {
        $_SESSION['pesan'] = "Email yang anda masukkan tidak ada!";
    }
    return;
}

function daftar($post)
{

    global $konek;

    $nama = htmlspecialchars($post['nama']);
    $email = htmlspecialchars($post['email']);
    $password1 = htmlspecialchars($post['sandi1']);
    $password2 = htmlspecialchars($post['sandi2']);
    $image = "default.png";
    $createat = date('y-m-d h:i:s');

    if (empty($nama)) {
        $_SESSION['pesan'] = 'Nama harus diisi!';
        return;
    }
    if (empty($email)) {
        $_SESSION['pesan'] = 'email harus diisi!';
        return;
    }
    if (empty($password1)) {
        $_SESSION['pesan'] = 'Password harus diisi!';
        return;
    }
    if ($password2 != $password1) {
        $_SESSION['pesan'] = 'Password harus sama!';
        return;
    }
    $sandi = password_hash($password2, PASSWORD_DEFAULT);

    mysqli_query($konek, "INSERT INTO users VALUES ('','$nama','$email','$sandi','$image', '2', '$createat', '') ");

    if (mysqli_affected_rows($konek)) {
        $_SESSION['sukses'] = 'Akun berhasil dibuat';
        return header('location:' . url . 'user');
    }
}
