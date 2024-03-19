<?php
session_start();
include '../config/koneksi.php';
include '../config/function.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = safeInput($conn, $_POST['user_id']);
    $nama = safeInput($conn, $_POST['nama']);
    $jk = safeInput($conn, $_POST['jk']);
    $tgl = safeInput($conn, $_POST['tgl']);
    $alamat = safeInput($conn, $_POST['alamat']);
    $nohp = safeInput($conn, $_POST['nohp']);
    $email = safeInput($conn, $_POST['email']);
    $jabatan = safeInput($conn, $_POST['jabatan']);
    $gaji = safeInput($conn, $_POST['gaji']);
    $tgl_gabung = safeInput($conn, $_POST['tgl_gabung']);

    $tipe_gambar = array("jpg", "jpeg", "png", "gif", "webp");
    $nama_file = $_FILES['photo']['name'];
    $explode = explode(".", $nama_file);
    $ekstensi = end($explode);
    $ukuran_file = $_FILES['photo']['size'];
    $tmp_name = $_FILES['photo']['tmp_name'];
    $path = '../gambar/' . $nama_file;

    if (in_array($ekstensi, $tipe_gambar)) {
        if ($ukuran_file < 2044070) {
            move_uploaded_file($tmp_name, $path);
            $data = [
                'user_id'=>$user_id,
                'nama' => $nama,
                'jenis_kelamin' => $jk,
                'tgl_lahir' => $tgl,
                'alamat' => $alamat,
                'no_hp' => $nohp,
                'email' => $email,
                'jabatan' => $jabatan,
                'gaji' => $gaji,
                'tgl_gabung' => $tgl_gabung,
                'foto' => $nama_file
            ];
            $save_data = insert_db($conn, 'pegawai', $data);
            if ($save_data) {
                $_SESSION['type'] = 'success';
                $_SESSION['alertx'] = 'Data berhasil tersimpan';
                header("Location: list_pegawai.php");
                exit();
            } else {
                $_SESSION['type'] = 'danger';
                $_SESSION['alertx'] = 'Data gagal tersimpan';
                header("Location: add_form.php");
                exit();
            }
        }
    }
}
