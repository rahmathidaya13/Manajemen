<?php
session_start();
include '../config/koneksi.php';
include '../config/function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = safeInput($conn, $_POST['id_user']);
    $tanggal = safeInput($conn, $_POST['tanggal']);
    $jam_masuk = safeInput($conn, $_POST['masuk']);
    $ket = safeInput($conn, $_POST['ket']);
    $latitude = safeInput($conn, $_POST['lat']);
    $longitude = safeInput($conn, $_POST['long']);

    $tipe_file = array('jpg', 'jpeg', 'png', 'svg', 'webp', 'gif');
    $nama_file = $_FILES['foto']['name'];
    $explode = explode('.', $nama_file);
    $extension = end($explode);
    $file_tmp = $_FILES['foto']['tmp_name'];
    $file_path = '../gambar/' . $nama_file;

    $cek_stts = mysqli_query($conn, "SELECT * FROM absensi WHERE user_id='$id' AND tanggal='$tanggal'");
    $cek = mysqli_fetch_array($cek_stts);
    if (empty($cek['jam_masuk'])) {
        if (!empty($nama_file)) {
            if (in_array($extension, $tipe_file) === true) {
                move_uploaded_file($file_tmp, $file_path);
                $data = [
                    'user_id' => $id,
                    'tanggal' => $tanggal,
                    'jam_masuk' => $jam_masuk,
                    'keterangan' => $ket,
                    'foto' => $nama_file,
                    'latitude'=> $latitude,
                    'longitude'=> $longitude,
                    'status' => 'absen'
                ];
                $save_absen = insert_db($conn, 'absensi', $data);
                if ($save_absen) {
                    $_SESSION['type'] = 'success';
                    $_SESSION['alertx'] = true;
                    header("Location: absen-masuk.php?tgl=" . urlencode($_GET['tgl']) . "&name=" . urlencode($_GET['name']));
                    exit();
                } else {
                    $_SESSION['type'] = 'danger';
                    $_SESSION['alert'] = 'Data Absensi Gagal Ditambahkan';
                    header("Location: absen-masuk.php?tgl=" . urlencode($_GET['tgl']) . "&name=" . urlencode($_GET['name']));
                    exit();
                }
            }
        } else {
            $_SESSION['invalid'] = 'Absen Wajib Menggunakan Photo';
            header("Location: absen-masuk.php?tgl=" . urlencode($_GET['tgl']) . "&name=" . urlencode($_GET['name']));
            exit();
        }
    } else {
        // $_SESSION['effect'] = 'toastrDefaultSuccess';
        // $_SESSION['valid'] = 'Sudah Melakukan Absensi Masuk';
        $_SESSION['invalidx'] = true;
        header("Location: absen-masuk.php?tgl=" . urlencode($_GET['tgl']) . "&name=" . urlencode($_GET['name']));
        exit();
    }
}
