<?php
session_start();
include '../config/koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = htmlspecialchars($_POST['user_id']);
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $level = htmlspecialchars($_POST['level']);

    $update = mysqli_prepare($conn, "UPDATE user SET username = ?,email = ?, level = ? WHERE id = ?");
    mysqli_stmt_bind_param($update, 'sssi', $username, $email, $level, $user_id);
    mysqli_stmt_execute($update);
    if ($update) {
        $_SESSION['type'] = 'success';
        $_SESSION['alert'] = 'Level telah diperbaharui sebagai';
        header("Location:role.php?level=".urlencode($_GET['level']));
        exit();
    } else {
        header("Location:update_level.php");
        exit();
    }
}
