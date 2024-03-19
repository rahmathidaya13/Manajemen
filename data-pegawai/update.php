<?php
session_start();
include '../config/koneksi.php';
include '../config/function.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = safeInput($conn,$_POST['user_id']);
    $id_pegawai = safeInput($conn,$_POST['id_pegawai']);
    $nama = safeInput($conn,$_POST['nama']);
    $jk = safeInput($conn,$_POST['jk']);
    $tgl = safeInput($conn,$_POST['tgl']);
    $alamat = safeInput($conn,$_POST['alamat']);
    $nohp = safeInput($conn,$_POST['nohp']);
    $email = safeInput($conn,$_POST['email']);
    $jabatan = safeInput($conn,$_POST['jabatan']);
    $gaji = safeInput($conn,$_POST['gaji']);
    $tgl_gabung = safeInput($conn,$_POST['tgl_gabung']);

    $tipe_gambar = array("jpg", "jpeg", "png", "gif", "webp");
    $nama_file = $_FILES['photo']['name'];
    $explode = explode(".", $nama_file);
    $ekstensi = end($explode);
    $ukuran_file = $_FILES['photo']['size'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    $path = '../gambar/' . $nama_file;

    // $cek_file = mysqli_query($conn, "SELECT foto FROM pegawai WHERE id_pegawai = '$id_pegawai'");
    $cek_file = select_where($conn, ['foto'], 'pegawai', 'id_pegawai', $id_pegawai);
    $old_data = mysqli_fetch_assoc($cek_file);
    $path_file = '../gambar/' . $old_data['foto'];
    if (file_exists($path_file) && unlink($path_file));

    if (in_array($ekstensi, $tipe_gambar)) {
        if ($ukuran_file < 2044070) {
            move_uploaded_file($tmp_name, $path);
            $data = [
                'user_id'=>$user_id,
                'nama'=>$nama, 
                'jenis_kelamin'=>$jk,
                'tgl_lahir'=>$tgl,
                'alamat'=>$alamat,
                'no_hp'=>$nohp,
                'email'=>$email,
                'jabatan'=>$jabatan,
                'gaji'=>$gaji,
                'tgl_gabung'=>$tgl_gabung,
                'foto'=>$nama_file
            ];
            $update_data = update_db($conn, 'pegawai', $data, 'id_pegawai', $id_pegawai);
            if ($update_data) {
                $_SESSION['type'] = 'success';
                $_SESSION['alert'] = 'Data berhasil diubah';
                header("Location:list_pegawai.php");
                exit();
            } else {
                $_SESSION['type'] = 'danger';
                $_SESSION['alert'] = 'Data gagal diubah';
                header("Location:edit-form.php");
                exit();
            }
        }
    }else{
        $data = [
            'user_id'=>$user_id,
            'nama'=>$nama, 
            'jenis_kelamin'=>$jk,
            'tgl_lahir'=>$tgl,
            'alamat'=>$alamat,
            'no_hp'=>$nohp,
            'email'=>$email,
            'jabatan'=>$jabatan,
            'gaji'=>$gaji,
            'tgl_gabung'=>$tgl_gabung,
        ];
        $update_data = update_db($conn, 'pegawai', $data, 'id_pegawai', $id_pegawai);
        if ($update_data) {
            $_SESSION['type'] = 'success';
            $_SESSION['alert'] = 'Data berhasil diubah';
            header("Location:list_pegawai.php");
            exit();
        } else {
            $_SESSION['type'] = 'danger';
            $_SESSION['alert'] = 'Data gagal diubah';
            header("Location:edit-form.php");
            exit();
        }
    }
}
