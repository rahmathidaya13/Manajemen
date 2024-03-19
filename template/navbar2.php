<?php
date_default_timezone_set("Asia/Jakarta");
$active = basename($_SERVER['PHP_SELF'], '.php');
$user = $_SESSION['username'] ?? '';
$user = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user'");
$lists = mysqli_fetch_array($user);

$date = date('Y-m-d');
$idx = $lists['id'];
$absen = mysqli_query($conn, "SELECT * FROM absensi WHERE tanggal='$date' AND user_id = '$idx'");
$abs = mysqli_fetch_array($absen);
$hour = date('H:m:s');
if ($hour >= '00:00' && $hour <= '06:59') {
    $_SESSION['masuk'] = 'd-none';
    $_SESSION['keluar'] = 'd-none';
} elseif ($hour >= '07:00' && $hour <= '12:00') {
    $_SESSION['masuk'] = '';
    $_SESSION['keluar'] = 'd-none';
} elseif ($hour >= '12:00' && $hour <= '17:00') {
    $_SESSION['masuk'] = '';
    $_SESSION['keluar'] = 'd-none';
} elseif ($hour >= '17:00' && $hour <= '23:59') {
    $_SESSION['masuk'] = '';
    $_SESSION['keluar'] = '';
}

?>
<nav class="navbar navbar-expand sticky-top navbar-light">
    <div class="container">
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a id="absen_masuk" class="nav-link <?php echo $_SESSION['masuk'] ?? '' ?> <?php echo ($active == 'absen-masuk') ? 'bg-primary' : '' ?>" href="../data-absensi/absen-masuk.php?tgl=<?php echo date('Y-m-d'); ?>&name=<?php echo $lists['username'] ?? '' ?>">Absen Masuk</a>
            </li>
            <?php if(isset($abs['status']) ? 'absen' : ''): ?>
            <li class="nav-item dropdown">
                <a id="absen_keluar" class="nav-link <?php echo $_SESSION['keluar'] ?? '' ?> <?php echo ($active == 'absen-keluar') ? 'bg-primary' : '' ?>" href="../data-absensi/absen-keluar.php?tgl=<?php echo $abs['tanggal'] ?? '0' ?>&id=<?php echo $abs['id_absensi'] ?? '0' ?>">Absen Keluar</a>
            </li>
           <?php endif ?>
            <div id="tes"></div>
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                    <?php echo ucwords($data['username']) ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="../data-absensi/home.php">Home</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" onclick="return confirm('Apakah yakin mau keluar ?')" href="../Auth/logout.php">Logout</a>
                </div>
            </div>
        </ul>
    </div>
</nav>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Panggil fungsi clock() saat halaman dimuat
        clock();
    });
    //  Absensi
    function clock() {
        moment.locale('en');
        let hour = moment().format('HH:mm');
        if (hour >= '00:00' && hour <= '06:59') {
            document.getElementById('absen_masuk').classList.add('d-none');
            document.getElementById('absen_keluar').classList.add('d-none');
        } else if (hour >= '07:00' && hour <= '12:00') {
            document.getElementById('absen_masuk').classList.remove('d-none'); // aktif
            document.getElementById('absen_keluar').classList.add('d-none'); // mati

        } else if (hour >= '12:00' && hour <= '17:00') {
            document.getElementById('absen_masuk').classList.add('d-none'); // mati
            document.getElementById('absen_keluar').classList.add('d-none'); // mati
        } else if (hour >= '17:00' && hour <= '23:59') {
            document.getElementById('absen_masuk').classList.add('d-none'); // mati 
            document.getElementById('absen_keluar').classList.remove('d-none'); // aktif
        }
    }
    setInterval(clock, 1000)
</script> -->