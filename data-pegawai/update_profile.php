<?php
session_start();
include '../config/koneksi.php';
include '../config/function.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = htmlspecialchars($_POST['id']);

    $tipe_gambar = array("jpg", "jpeg", "png", "gif", "webp");
    $nama_file = time() . $_FILES['foto']['name'];
    $explode = explode(".", $nama_file);
    $ekstensi = end($explode);
    $ukuran_file = $_FILES['foto']['size'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $path = '../profile/' . $nama_file;

    // ambil foto dari database, kalau ada foto didalam database ketika diupdate foto lama akan dihapus
    $cek_file = select_where($conn, ['foto'], 'user', 'id',$id);
    $old_data = mysqli_fetch_assoc($cek_file);
    $old_path = '../profile/' . $old_data['foto'];
    if (file_exists($old_path) && unlink($old_path));

    if (in_array($ekstensi, $tipe_gambar)) {
        if ($ukuran_file < 2044070) {
            move_uploaded_file($tmp_name, $path);
            $data = ['foto'=>$nama_file];
            $query = update_db($conn, 'user', $data,'id',$id);
            if ($query) {
                $_SESSION['type'] = 'success';
                $_SESSION['alert'] = 'Photo profile berhasil terubah';
                header("Location:profile.php?custom=" . urlencode($_GET['custom']));
                exit();
            } else {
                $_SESSION['type'] = 'danger';
                $_SESSION['alert'] = 'Photo profile gagal diubah';
                header("Location:profile.php?custom=" . urlencode($_GET['custom']));
                exit();
            }
        }
    }
}
