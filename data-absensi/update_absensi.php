<?php
session_start();
include '../config/koneksi.php';
include '../config/function.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = safeInput($conn, $_POST['id_user']);
    $id_absen = safeInput($conn, $_POST['id_absen']);
    $tanggal = safeInput($conn, $_POST['tanggal']);
    $jam_keluar = safeInput($conn, $_POST['keluar']);
    $ket = safeInput($conn, $_POST['ket']);

    $cek_absen = mysqli_query($conn, "SELECT * FROM absensi WHERE id_absensi = '$id_absen' AND tanggal = '$tanggal'");
    $cek = mysqli_fetch_array($cek_absen);
    if (empty($cek['jam_keluar'])) {
        // value query to sql
        $data = [
            'user_id' => $id_user,
            'tanggal' => $tanggal,
            'jam_keluar' => $jam_keluar,
            'keterangan' => $ket
        ];
        $update = update_db($conn, 'absensi', $data, 'id_absensi', $id_absen);
        if ($update) {
            $_SESSION['type'] = 'success';
            $_SESSION['alertx'] = true;
            header("Location: absen-keluar.php?tgl=" . urlencode($_GET['tgl']) . "&id=" . urlencode($_GET['id']));
            exit();
        } else {
            $_SESSION['type'] = 'danger';
            $_SESSION['alert'] = 'Data gagal diupdate';
            header("Location: absen-keluar.php?tgl=" . urlencode($_GET['tgl']) . "&id=" . urlencode($_GET['id']));
            exit();
        }
    } else {
        $_SESSION['invalidx'] = true;
        header("Location: absen-keluar.php?tgl=" . urlencode($_GET['tgl']) . "&id=" . urlencode($_GET['id']));
        exit();
    }
}
