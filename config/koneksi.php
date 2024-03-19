<?php 
$localhost = 'localhost';
$username = 'root';
$password = '';
$database = 'db_manajemenpegawai';
$conn = mysqli_connect($localhost, $username, $password, $database);
if(!$conn){
    die("Koneksi Gagal". mysqli_connect_error());
}
?>