<?php
session_start();
include '../../config/koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_var(htmlspecialchars($_POST['username']), FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var(htmlspecialchars($_POST['email']), FILTER_VALIDATE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $cp_password = password_hash($_POST['cp-password'], PASSWORD_DEFAULT);

    if ($password != $cp_password) {
        $sql = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");
        if (!mysqli_num_rows($sql)) {
            $query = mysqli_prepare($conn, "INSERT INTO user (username,email,password) VALUES (?,?,?)");
            mysqli_stmt_bind_param($query, 'sss', $username, $email, $password);
            mysqli_stmt_execute($query);
            if ($query) {
                $_SESSION['type'] = 'success';
                $_SESSION['alert'] = 'Pendaftaran Berhasil';
                header("Location:../../Auth/login.php");
                exit();
            } else {
                $_SESSION['type'] = 'danger';
                $_SESSION['alert'] = 'Pendaftaran Gagal';
                header("Location:../../Auth/register.php");
                exit();
            }
        }
    }
}
