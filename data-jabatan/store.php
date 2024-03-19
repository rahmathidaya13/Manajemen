<?php
session_start();
include '../config/koneksi.php';
include '../config/function.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jabatan = safeInput($conn,$_POST['jabatan']);
    $data = ['nama_jabatan'=>$jabatan];
    $save_absen = insert_db($conn, 'jabatan', $data);
    if ($save_absen) {
        $_SESSION['type'] = 'success';
        $_SESSION['alert'] = 'Data Jabatan Berhasil Ditambahkan';
        header("Location: add-form.php");
        exit();
    }else{
        $_SESSION['type'] = 'danger';
        $_SESSION['alert'] = 'Data Jabatan Gagal Ditambahkan';
        header("Location: add-form.php");
        exit();
    }
}
