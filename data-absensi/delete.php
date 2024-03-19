<?php 
session_start();
include '../config/koneksi.php';
include '../config/function.php';
if (isset($_GET['delete'])) {
    $id = htmlspecialchars($_GET['delete']);
    $delete = destroy($conn, 'absensi', 'id_absensi', $id);
    if ($delete) {
        $_SESSION['type'] = 'success';
        $_SESSION['alert'] = 'Data berhasil dihapus!';
        header("Location:list_absensi.php");
        exit();
    }else{
        $_SESSION['type'] = 'danger';
        $_SESSION['alert'] = 'Data gagal dihapus!';
        header("Location:list_absensi.php");
        exit();
    }
}
?>