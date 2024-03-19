<?php
$GLOBALS['title'] = 'Data Absensi';
$GLOBALS['active_absen'] = 'active';
// fetch data dari tabel user
include '../fetch_data/index.php';
include '../template/header.php';
include '../template/navbar2.php';
include '../config/koneksi.php';
include '../config/function.php';
if (isset($_GET['tgl']) && isset($_GET['id'])) {
    $get_id = safeInput($conn,  $_GET['id']);
    $get_tgl = safeInput($conn,  $_GET['tgl']);
    // $data_pegawai = join_table($conn, 'user','*','absensi','*', 'inner join','id', 'user_id', 'username', $get_name);
    $absen = mysqli_query($conn, "SELECT user.*, absensi.* FROM absensi INNER JOIN user ON user.id = absensi.user_id WHERE absensi.id_absensi='$get_id' AND absensi.tanggal = '$get_tgl'");
    $list = mysqli_fetch_assoc($absen);
}

?>
<style>
    #foto {
        display: none;
    }

    #show {
        width: 100px;
        height: 100px;
    }

    .bg {
        background-color: rgba(233, 0, 0, 1);
        color: white;
        border-radius: 5px;
        height: 50px;
        justify-content: center;
        margin-left: auto;
        margin-right: auto;
        position: relative;
        /* box-shadow: 2px 3px 10px black; */
    }

    .bg,
    p {
        text-align: start;
        padding: 6px;
        font-size: 17px;
    }

    .closex {
        color: black;
        font-weight: bold;
    }

    .closex:hover {
        color: black;
    }
</style>
<div class="container py-3">
    <div class="row d-flex justify-content-center">
        <div class="col-md-5">
            <!-- <h3 class="py-0 text-center">Absensi Karyawan</h3> -->
            <?php if (isset($_SESSION['valid'])) : ?>
                <div class="bg mb-3 ">
                    <div class="d-flex justify-content-between">
                        <p class="ml-1"><i class="fas fa-exclamation-triangle mr-1"></i> <?php echo $_SESSION['valid'] ?? '' ?></p>
                        <p><a class="closex" href="">Close</a></p>
                    </div>
                </div>
            <?php endif;
            unset($_SESSION['valid']) ?>
            <div class="card shadow">
                <div class="card-body">
                    <form action="update_absensi.php?tgl=<?php echo $list['tanggal'] ?>&id=<?php echo $list['id_absensi'] ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_user" value="<?php echo $list['id'] ?>">
                        <input type="hidden" name="id_absen" value="<?php echo $list['id_absensi'] ?>">
                        <div class="mb-3">
                            <div class="d-flex justify-content-center">
                                <img id="show" style="border: 2px solid grey;" src="<?php echo isset($list['foto']) ? '../gambar/' . $list['foto'] : '../profile/noimage.jpg' ?>" alt="foto" class="img-fluid rounded-circle">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                                </div>
                                <input type="text" class="form-control" name="nama" readonly value="<?php echo ucwords($list['username'] ?? '') ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanggal</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <input type="date" class="form-control" name="tanggal" readonly value="<?php echo $list['tanggal'] ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jam</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                </div>
                                <input type="text" class="form-control" name="keluar" id="jam_keluar" readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jam Keluar</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                </div>
                                <input type="text" class="form-control" value="17:00" readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Keterangan</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-pen"></i></div>
                                </div>
                                <input type="text" class="form-control text-danger" name="ket" value="<?php echo $list['keterangan'] ?? '' ?>" readonly />
                                <i class="text-danger text-start">*Keterlambatan lebih dari 30 menit akan mendapatkan sanksi sesuai dengan peraturan perusahaan yang berlaku</i>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary btn-block">Absen Keluar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let input = document.getElementById('foto');
    let show = document.getElementById('show');
    input.addEventListener('change', (event) => {
        let preview = event.target.files[0];
        show.src = URL.createObjectURL(preview);
    })
</script>
<script>
    //  Absensi
    function clock() {
        moment.locale('en');
        let clock = moment().format('HH:mm:ss');
        let hour = moment().format('HH:mm');
        document.getElementById('jam_keluar').value = clock;
        if (hour >= '16:00' && hour <= '16:30') {
            document.getElementById('ket').value = 'Bersiap-siap untuk waktu pulang';
            document.getElementById('ket').classList.remove('text-danger');
        } else if (hour >= '16:30' && hour <= '17:00') {
            document.getElementById('ket').value = 'Lakukan absen sebelum pulang';
            document.getElementById('ket').classList.remove('text-danger');
        } else {
            document.getElementById('ket').value = '';
        }
    }
    setInterval(clock, 1000)
</script>
<?php include '../template/footer.php' ?>
<?php if (isset($_SESSION['alertx'])) : ?>
    <script>
        $(document).ready(function() {
            toastr.success('Absensi Pulang Berhasil', 'Success', {
                positionClass: 'toast-top-center',
            });
        });
    </script>
<?php elseif (isset($_SESSION['invalidx'])):  ?>
    <script>
        $(document).ready(function() {
            toastr.error('Sudah Melakukan Absensi', 'Error', {
                positionClass: 'toast-top-center',
            });
        });
    </script>
<?php endif;
unset($_SESSION['alertx'],$_SESSION['invalidx']); ?>