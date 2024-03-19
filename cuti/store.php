<?php
session_start();
include '../config/koneksi.php';
include '../config/function.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = safeInput($conn,$_POST['pegawai']);
    $pengajuan = safeInput($conn,$_POST['pengajuan']);
    $tgl_mulai = safeInput($conn,$_POST['tgl_mulai']);
    $tgl_selesai = safeInput($conn,$_POST['tgl_selesai']);
    $jenis_cuti = safeInput($conn,$_POST['jenis_cuti']);
    $ket = safeInput($conn,$_POST['ket']);
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    $data = [
        'id_pegawai'=>$nama,
        'tgl_pengajuan' => $pengajuan,
        'tgl_mulai' => $tgl_mulai,
        'tgl_selesai' => $tgl_selesai,    
        'jenis_cuti' => $jenis_cuti,
        'keterangan'=>$ket,
        'created_at'=>$created_at
    ];
    $save_cuti = insert_db($conn, 'cuti', $data);
    if ($save_cuti > 0) {
        $_SESSION['type'] = 'success';
        $_SESSION['alert'] = 'Pengajuan Cuti Berhasil, Harap Menunggu Informasi Selanjutnya';
        header("Location: add-form.php");
        exit();
    }else{
        $_SESSION['type'] = 'danger';
        $_SESSION['alert'] = 'Pengajuan Cuti Tidak Dapat Dibuat';
        header("Location: add-form.php");
        exit();
    }
}
