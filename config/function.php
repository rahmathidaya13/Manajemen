<?php
include 'koneksi.php';
date_default_timezone_set("Asia/Jakarta");
// Fungsi untuk membersihkan input
function safeInput($mysql, $secure)
{
    $data = mysqli_real_escape_string($mysql, $secure);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}
// Fungsi untuk mengenkripsi password (belum diimplementasikan)
function passwordSafe()
{
}
// Fungsi untuk mengubah nama hari dalam bahasa Inggris menjadi bahasa Indonesia
function date_convert($convert_day)
{
    $day = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu',
    ];
    $result = $day[date('l', strtotime($convert_day))];
    $date = date("d-m-Y H:i:s", strtotime($convert_day)) . " $result";
    return $date;
}
// Fungsi untuk melakukan pencarian data
function search($mysql, $table, $where, $keyword)
{
    $query = mysqli_query($mysql, "SELECT * FROM $table WHERE $where LIKE '%$keyword%'");
    return $query;
}
// Fungsi untuk mengambil semua data dari tabel
function select_all($mysql, $table)
{
    $query = mysqli_query($mysql, "SELECT * FROM $table");
    return $query;
}
// Fungsi untuk mengambil kolom tertentu dari tabel
function select_col($mysql, $column = [], $table)
{
    $select_string = implode(',', $column);
    $query = mysqli_query($mysql, "SELECT $select_string FROM $table");
    return $query;
}
// Fungsi untuk mengambil data dari tabel berdasarkan kondisi where
function select_where($mysql, $column = [], $table, $where, $value)
{
    $select_string = implode(', ', $column);
    $query = mysqli_query($mysql, "SELECT $select_string FROM $table WHERE $where = '$value'");
    return $query;
}
// Fungsi untuk mengambil data dari tabel dengan sorting dan limit
function select_order($mysql, $column = [], $table, $value, $order, $limit, $string)
{
    $select = implode(',', $column);
    $query = mysqli_query($mysql, "SELECT $select FROM $table ORDER BY $value $order LIMIT $limit,$string");
    return $query;
}
// Fungsi untuk menambah data ke database
function insert_db($mysql, $table, $data = [])
{
    $column = implode(', ', array_keys($data));
    $values = "'" . implode("', '", $data) . "'";
    $query = mysqli_query($mysql, "INSERT INTO $table ($column) VALUES ($values)");
    return $query;
}
// Fungsi untuk mengupdate data di database
function update_db($mysql, $table, $set = [], $where, $value)
{
    foreach ($set as $column => $val) {
        $update[] = "$column = '$val'";
    }
    $update_string = implode(', ', $update);
    var_dump($update_string);
    $query = mysqli_query($mysql, "UPDATE $table SET $update_string WHERE $where = '$value'");
    return $query;
}
// Fungsi untuk menghapus data di database
function destroy($mysql, $table, $where, $value)
{
    $query = mysqli_query($mysql, "DELETE FROM $table WHERE $where = '$value'");
    return $query;
}
// Fungsi untuk melakukan join dua tabel
function join_table($mysql, $table1, $attribute1, $table2, $attribute2, $type_join, $table_id_1, $table_id_2, $where_id, $value_id)
{
    // mysqli_query($conn, "SELECT absensi.*, pegawai.* FROM absensi INNER JOIN pegawai ON absensi.id_pegawai = pegawai.id_pegawai WHERE absensi.id_absensi = '$id'");
    $sql = "SELECT $table1.$attribute1, $table2.$attribute2 FROM $table1 $type_join $table2 ON $table1.$table_id_1 = $table2.$table_id_2 WHERE $table1.$where_id = '$value_id'";
    $query = mysqli_query($mysql, $sql);
    return $query;
}
// Fungsi untuk melakukan join dua tabel tanpa where
function joinTb_not_where($mysql, $table1, $attr1, $table2, $attr2, $type_join, $id_1, $id_2)
{
    $sql = "SELECT $table1.$attr1, $table2.$attr2 FROM $table1 $type_join $table2 ON $table1.$id_1 = $table2.$id_2";
    $query = mysqli_query($mysql, $sql);
    return $query;
}

function count_query_where($mysql, $attr, $table, $where, $value)
{
    $sql = "SELECT COUNT(*) AS $attr FROM $table WHERE $where = $value";
    $query = mysqli_query($mysql, $sql);
    return $query;
}
function count_all($mysql, $attr, $table)
{
    $sql = "SELECT COUNT(*) AS $attr FROM $table";
    $query = mysqli_query($mysql, $sql);
    return $query;
}
function token_csrf()
{
    $token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $token;
    return $token;
}
function unset_token()
{
    unset($_SESSION['csrf_token']);
}