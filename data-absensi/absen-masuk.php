<?php
$GLOBALS['title'] = 'Data Absensi';
$GLOBALS['active_absen'] = 'active';
// fetch data dari tabel user
include '../fetch_data/index.php';
include '../template/header.php';
include '../template/navbar2.php';
include '../config/koneksi.php';
include '../config/function.php';
if (isset($_GET['name']) && isset($_GET['tgl'])) {
    $get_tgl = safeInput($conn, $_GET['tgl']);
    $get_name = safeInput($conn,  $_GET['name']);
    $data_pegawai = select_where($conn, ['*'], 'user', 'username', $get_name);
    $list = mysqli_fetch_array($data_pegawai);
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

    .toast-width {
        padding: 50px;
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
</style>
<div class="container py-3">
    <div class="row d-flex justify-content-center">
        <div class="col-md-5">
            <?php if (isset($_SESSION['valid'])) : ?>
                <div class="bg mb-3 ">
                    <div class="d-flex justify-content-between">
                        <p class="ml-1"><i class="fas fa-exclamation-triangle mr-1"></i> <?php echo $_SESSION['valid'] ?? '' ?></p>
                        <p><a class="closex" href="">Close</a></p>
                    </div>
                </div>
            <?php endif;
            unset($_SESSION['valid']) ?>

            <!-- <h3 class="py-0 text-center">Absensi Karyawan</h3> -->
            <div class="card" style="border-radius: 20px;">
                <div class="card-body">
                    <form action="store.php?tgl=<?php echo $get_tgl ?>&name=<?php echo safeInput($conn, $list['username']) ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_user" value="<?php echo $list['id'] ?>">
                        <div class="mb-3">
                            <div class="d-flex justify-content-center">
                                <img id="show" style="border: 2px solid grey;" src="../profile/noimage.jpg" alt="foto" class="img-fluid rounded-circle">
                            </div>
                            <div class="d-flex justify-content-center">
                                <label style="font-size: 13px;" for="foto" class="badge rounded-pill btn btn-primary btn-sm mt-1 px-2 py-2"><i class="fas fa-plus"></i> Add Photo</label>
                                <input accept="image/*" type="file" class="form-control" id="foto" name="foto">
                            </div>
                            <?php if (isset($_SESSION['invalid'])) : ?>
                                <div class="text-danger text-center">
                                    <i><?php echo $_SESSION['invalid'] ?? '' ?></i>
                                </div>
                            <?php endif;
                            unset($_SESSION['invalid']) ?>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                                </div>
                                <input type="text" class="form-control" name="nama" readonly value="<?php echo ucwords($list['username']) ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tanggal</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                <input type="date" class="form-control" name="tanggal" readonly value="<?php echo date('Y-m-d') ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jam</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                </div>
                                <input type="text" class="form-control" name="masuk" id="jam_masuk" readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jam Masuk</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                </div>
                                <input type="text" class="form-control" value="08:30" readonly />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Keterangan</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-pen"></i></div>
                                </div>
                                <input type="text" class="form-control text-danger" id="ket" readonly name="ket" />
                                <i class="text-danger text-start">*Keterlambatan lebih dari 30 menit akan mendapatkan sanksi sesuai dengan peraturan perusahaan yang berlaku</i>
                            </div>
                        </div>
                        <div>
                            <input class="form-control" type="hidden" name="lat" id="latitude">
                            <input class="form-control" type="hidden" name="long" id="longitude">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary btn-block rounded-pill">Absen Masuk</button>
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
        document.getElementById('jam_masuk').value = clock;
        if (hour >= '07:00' && hour <= '08:30') {
            document.getElementById('ket').value = 'Tepat Waktu ' + hour;
            document.getElementById('ket').classList.remove('text-danger');
        } else if (hour >= '08:30' && hour <= '12:00') {
            document.getElementById('ket').value = 'Telat ' + hour;
        } else {
            document.getElementById('ket').value = '';
        }
    }
    setInterval(clock, 1000)
</script>

<?php include '../template/footer.php' ?>
<script>
    function ambilTitikLokasi() {
        // Buat objek Geolocation
        var geolocation = new Geolocation();

        // Ambil titik lokasi
        geolocation.getLocation(function(location) {
            document.getElementById("latitude").value = location.lat;
            document.getElementById("longitude").value = location.lng;
        });
    }
</script>
<?php if (isset($_SESSION['alertx'])) : ?>
    <script>
        $(document).ready(function() {
            toastr.success('Absensi Berhasil', 'Success', {
                positionClass: 'toast-top-center',
            });
        });
    </script>
<?php elseif (isset($_SESSION['invalidx'])) :  ?>
    <script>
        $(document).ready(function() {
            toastr.error('Sudah Melakukan Absensi', 'Error', {
                positionClass: 'toast-top-center',
            });
        });
    </script>
<?php endif;
unset($_SESSION['alertx'], $_SESSION['invalidx']); ?>

<script>
    function getlocation() {
        if (navigator.geolocation) {
            let options = {
                // Properti ini digunakan untuk meminta perangkat untuk memberikan lokasi dengan akurasi tinggi,
                enableHighAccuracy: true,
                // Properti ini digunakan untuk menentukan berapa lama lokasi yang disimpan dalam cache dapat digunakan sebelum meminta lokasi yang baru
                maximunAge: 30000,
                // Properti ini digunakan untuk menentukan berapa lama browser harus menunggu respons saat mencoba untuk mendapatkan lokasi sebelum memicu kesalahan
                timeout: 15000
            }
            navigator.geolocation.getCurrentPosition(showPosition, showError, options);
        } else {
            alert('Perangkat Kamu Tidak Mendukung');
        }
    }

    function showPosition(data) {
        document.getElementById('latitude').value = data.coords.latitude;
        document.getElementById('longitude').value = data.coords.longitude;
    }


    function showError(error) {
        console.log(error);
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert('Anda telah menolak untuk memberikan izin akses lokasi, Harap aktifkan lokasi untuk menggunakan aplikasi ini');
                window.location = 'home.php';
                break;
            case error.POSITION_UNAVAILABLE:
                alert('Informasi lokasi tidak tersedia');
                break;
            case error.TIME_OUT:
                alert('Waktu permintaan telah berakhir');
                break;
            case error.UNKNOWN_ERROR:
                alert('Terjadi kesalahan yang tidak diketahui');
                break;
        }
    }

    function modalActive() {
        // let modal = document.getElementById('modal-default');
        // modal.classList.add('show');
        // modal.style.display = 'block';
        // modal.setAttribute('aria-modal', 'true');

        $('#modal-default').modal('show');

    }
    document.addEventListener('DOMContentLoaded', function() {
        getlocation()
    });
</script>