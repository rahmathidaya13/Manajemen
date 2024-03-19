<?php
$GLOBALS['title'] = 'Form edit absensi';
$GLOBALS['active_absen'] = 'active';
include '../fetch_data/index.php';
include '../template/header.php';
include '../template/sidebar.php';
include '../template/navbar.php';
include '../config/koneksi.php';
include '../config/function.php';
if(isset($_GET['modify'])){
    $id = safeInput($conn,$_GET['modify']);
    $absensi = join_table($conn, 'absensi','*','user','*','INNER JOIN','user_id','id','id_absensi',$id);
    $rows = mysqli_fetch_assoc($absensi);
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-5">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Pegawai</h3>
                        </div>
                        <div class="card-body">
                            <form action="update_absensi.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_absen" value="<?php echo $rows['id_absensi'] ?>" >
                                <div class="form-group">
                                    <label>Nama Pegawai</label>
                                    <select class="form-control"  name="id" id="id">
                                       <option value="<?php echo $rows['id'] ?>"><?php echo ucwords($rows['username']) ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input class="form-control" value="<?php echo $rows['tanggal'] ?>" type="date" name="tanggal" id="tanggal">
                                </div>
                                <div class="form-group">
                                    <label>Jam Masuk</label>
                                    <input type="time" value="<?php echo $rows['jam_masuk'] ?>" name="jam_masuk" class="form-control my-colorpicker1">
                                </div>
                                <div class="form-group">
                                    <label>Jam Keluar</label>
                                    <input type="time" value="<?php echo $rows['jam_keluar'] ?>" name="jam_keluar" class="form-control my-colorpicker1">
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input class="form-control" type="text" value="<?php echo $rows['keterangan'] ?>" name="ket" id="ket">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary px-3">Simpan</button>
                                    <button type="reset" class="btn btn-danger px-3">Hapus</button>
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