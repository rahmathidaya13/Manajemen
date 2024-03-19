<?php 
session_start();
include '../../config/koneksi.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = filter_var(htmlspecialchars($_POST['username']), FILTER_SANITIZE_SPECIAL_CHARS);
    $password = htmlspecialchars($_POST['password']);
    // Cek username dan password di database
    $query = mysqli_prepare($conn, "SELECT id,username,password,level FROM user WHERE username = ?");
    mysqli_stmt_bind_param($query, 's', $username);
    mysqli_stmt_execute($query);
    $results = mysqli_stmt_get_result($query);
    $data = mysqli_fetch_assoc($results);
    if($data && password_verify($password, $data['password'])){
        $_SESSION['username'] = $data['username']; 
        $_SESSION['id'] = $data['id']; 
        $_SESSION['level'] = $data['level'];
        if($_SESSION['level'] == 'admin'){
            session_regenerate_id();
            header("Location:../../dashboard/home.php");
        }elseif($_SESSION['level'] == 'hrd'){
            session_regenerate_id();
            header("Location:../../dashboard/home.php");
        }elseif($_SESSION['level'] == 'pegawai'){
            session_regenerate_id();
            header("Location:../../data-absensi/home.php");
        }
        exit();
    }else{
        $_SESSION['type'] = 'danger';
        $_SESSION['alert'] = 'Username dan Password Salah';
        header("Location:../../Auth/login.php");
    }
}
?>