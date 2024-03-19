<?php
$GLOBALS['title'] = 'Form Jabatan';
$GLOBALS['active_cuti'] = 'active';
include '../fetch_data/index.php';
include '../template/header.php';
include '../template/sidebar.php';
include '../template/navbar.php';
include '../config/koneksi.php';
include '../config/function.php';

$pegawai = select_all($conn, 'pegawai');
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <?php if (!empty($_SESSION["alert"])) : ?>
                        <div class="alert alert-<?php echo $_SESSION["type"] ?> alert-dismissible fade show" role="alert">
                            <strong><?php echo $_SESSION["alert"] ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php unset($_SESSION["alert"]); ?>
                    <?php endif; ?>

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Form Permohonan Cuti</h3>
                        </div>
                        <div class="card-body">
                            <form action="store.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Pegawai</label>
                                           <select class="form-control select2" name="pegawai">
                                                <?php foreach($pegawai as $data) : ?>
                                                <option value="<?php echo $data['id_pegawai'] ?>"><?php echo $data['nama'] ?></option>
                                                <?php endforeach ?>
                                           </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label>Tanggal Pengajuan</label>
                                           <input class="form-control" type="date" name="pengajuan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label>Tanggal Mulai</label>
                                           <input class="form-control" type="date" name="tgl_mulai">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label>Tanggal Selesai</label>
                                           <input class="form-control" type="date" name="tgl_selesai">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label>Jenis Cuti</label>
                                           <input class="form-control" type="text" name="jenis_cuti">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label>Keterangan</label>
                                           <input class="form-control" type="text" name="ket">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group ">
                                            <button type="submit" name="submit" class="btn btn-primary px-3">Ajukan</button>
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