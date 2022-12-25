<?php
session_start();

unset($_SESSION['nama']);
unset($_SESSION['iduser']);
unset($_SESSION['email']);
unset($_SESSION['tglMasuk']);

return header('location:index.php');
