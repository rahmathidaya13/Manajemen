<?php
session_start();
include '../config/koneksi.php';
include '../config/function.php';
if (isset($_GET['delete'])) {
    $get = safeInput($conn,$_GET['delete']);

    $cek_file = select_where($conn, ['foto'], 'pegawai', 'id_pegawai', $get);
    $old_data = mysqli_fetch_assoc($cek_file);
    $path_file = '../gambar/' . $old_data['foto'];
    
    $delete = destroy($conn, 'pegawai', 'id_pegawai', $get);
    if ($delete) {
        // cek apakah file ada
        if (file_exists($path_file)) {
            // hapus file dari server
            unlink($path_file);
            $_SESSION['type'] = 'success';
            $_SESSION['alert'] = 'Data berhasil terhapus';
            header("Location:list_pegawai.php");
            exit();
        } else {
            $_SESSION['type'] = 'danger';
            $_SESSION['alert'] = 'Data gagal terhapus';
            header("Location:list_pegawai.php");
            exit();
        }
    }
}
