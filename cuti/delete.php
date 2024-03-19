<?php 
session_start();
include '../config/koneksi.php';
include '../config/function.php';
if (isset($_GET['delete'])) {
    $id = htmlspecialchars($_GET['delete']);
    $delete = destroy($conn, 'cuti', 'id_cuti', $id);
    if ($delete > 0) {
        $_SESSION['type'] = 'success';
        $_SESSION['alert'] = 'Data berhasil dihapus!';
        header("Location:list.php");
        exit();
    }else{
        $_SESSION['type'] = 'danger';
        $_SESSION['alert'] = 'Data gagal dihapus!';
        header("Location:list.php");
        exit();
    }
}
?>