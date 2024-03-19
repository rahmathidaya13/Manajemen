<?php
session_start();
ob_start();
include '../config/koneksi.php';
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'] ?? '';
    // $user = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ?");
    $user = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ?");
    mysqli_stmt_bind_param($user, 's', $username);
    mysqli_stmt_execute($user);
    $result = mysqli_stmt_get_result($user);
    $data = mysqli_fetch_assoc($result);
    mysqli_stmt_close($user);
} else {
    header("Location:../Auth/login.php");
    exit();
}
