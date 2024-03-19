<?php
$GLOBALS['title'] = 'Data Absensi';
$GLOBALS['active_absen'] = 'active';
// fetch data dari tabel user
include '../fetch_data/index.php';
include '../template/header.php';
include '../template/navbar2.php';
include '../config/koneksi.php';
include '../config/function.php';
if(isset($_SESSION['username'])){
    $user = $_SESSION['username'];
    $data_pegawai = select_where($conn, ['*'], 'user','username',$user);
    $list = mysqli_fetch_array($data_pegawai);
}
?>


<?php include '../template/footer.php' ?>