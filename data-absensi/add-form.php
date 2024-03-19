<?php
$GLOBALS['title'] = 'Form Absensi';
$GLOBALS['active_absen'] = 'active';
include '../fetch_data/index.php';
include '../template/header.php';
include '../template/sidebar.php';
include '../template/navbar.php';
include '../config/function.php';
$data_pegawai = select_col($conn, ['id_pegawai', 'nama'], 'pegawai');
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Form Input Absensi</h3>
                        </div>
                        <div class="card-body">
                            <form action="store.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value="<?php echo $data['id'] ?>">

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Nama Pegawai</label>
                                            <select class="form-control" name="id_pegawai" id="id_pegawai">
                                                <?php foreach ($data_pegawai as $rows) : ?>
                                                    <option value="<?php echo $rows['id_pegawai'] ?>"><?php echo $rows['nama'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Tanggal</label>
                                            <input class="form-control" type="date" name="tanggal" id="tanggal">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Jam Masuk</label>
                                            <input type="time" name="jam_masuk" class="form-control my-colorpicker1">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Jam Keluar</label>
                                            <input type="time" name="jam_keluar" class="form-control my-colorpicker1">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input class="form-control" type="text" name="ket" id="ket">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="submit" class="btn btn-primary px-3">Simpan</button>
                                            <button type="reset" class="btn btn-danger px-3">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include '../template/footer.php' ?>