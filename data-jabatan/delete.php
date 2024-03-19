<?php 
session_start();
include '../config/koneksi.php';
include '../config/function.php';
if (isset($_GET['delete'])) {
    $id = htmlspecialchars($_GET['delete']);
    $jabatan = select_where($conn, ['*'],'jabatan', 'id_jabatan', $id);
    $field = mysqli_fetch_assoc($jabatan);
    $delete = destroy($conn, 'jabatan', 'id_jabatan', $id);
    if ($delete > 0) {
        $_SESSION['type'] = 'success';
        $_SESSION['alert'] = "Jabatan "."<b>".$field['nama_jabatan']."</b>"." Berhasil Dihapus!";
        header("Location:list.php");
        exit();
    }else{
        $_SESSION['type'] = 'danger';
        $_SESSION['alert'] = 'Data gagal dihapus!';
        header("Location:list.php");
        exit();
    }
}
