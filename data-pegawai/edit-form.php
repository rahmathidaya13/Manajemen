<?php
$GLOBALS['title'] = 'Form edit pegawai';
$GLOBALS['active_pegawai'] = 'active';
include '../config/koneksi.php';
include '../config/function.php';
include '../fetch_data/index.php';
include '../template/header.php';
include '../template/sidebar.php';
include '../template/navbar.php';
if (isset($_GET['modify'])) {
    $get = mysqli_real_escape_string($conn, htmlspecialchars($_GET['modify']));
    $pegawai = select_where($conn, ['*'], 'pegawai', 'id_pegawai', $get);
    $rows = mysqli_fetch_assoc($pegawai);
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Pegawai</h3>
                        </div>
                        <div class="card-body">
                            <form action="update.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value="<?php echo $rows['user_id'] ?>">
                                <input type="hidden" name="id_pegawai" value="<?php echo $rows['id_pegawai'] ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="nama" id="nama" value="<?php echo $rows['nama'] ?>" class="form-control  my-colorpicker1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-control" name="jk" id="jk">
                                                <option style="font-weight: bold;" selected value="<?php echo $rows['jenis_kelamin'] ?>"><?php echo $rows['jenis_kelamin'] ?></option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" name="tgl" value="<?php echo $rows['tgl_lahir'] ?>" class="form-control my-colorpicker1">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No Handphone</label>
                                            <input type="number" name="nohp" value="<?php echo $rows['no_hp'] ?>" class="form-control my-colorpicker1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" value="<?php echo $rows['email'] ?>" class="form-control my-colorpicker1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <select class="form-control" name="jabatan" id="jabatan">
                                                <option style="font-weight: bold;" value="0">Pilih Jabatan</option>
                                                <?php 
                                                $jabatan = select_all($conn, 'jabatan');
                                                foreach($jabatan as $jabat):
                                                    $selected = ($jabat['nama_jabatan'] == $rows['jabatan']) ? 'selected' : '';
                                                ?>
                                                <option value="<?php echo $jabat['nama_jabatan'] ?>" <?php echo $selected ?>><?php echo $jabat['nama_jabatan'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gaji</label>
                                            <input type="number" name="gaji" value="<?php echo $rows['gaji'] ?>" class="form-control my-colorpicker1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Bergabung</label>
                                            <input type="date" name="tgl_gabung" value="<?php echo $rows['tgl_gabung'] ?>" class="form-control my-colorpicker1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="3"><?php echo $rows['alamat'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <img style="border: 1px solid #000;" id="show_img" src="<?php echo isset($rows['foto']) ? '../gambar/'.$rows['foto'] : '../gambar/noimage/noimage.jpg"' ?>" class="img-fluid mb-2" width="70" height="70" alt="">
                                            <input type="file" name="photo" id="photo" accept="image/*" class="form-control my-colorpicker1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="submit" name="submit" id="" class="btn btn-primary px-3">Ubah</button>
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
<script>
    let inputfile = document.getElementById("photo");
    let buttonupdate = document.getElementById("submit");
    inputfile.addEventListener("change", () => {
        buttonupdate.classList.remove("btn-secondary");
        buttonupdate.classList.add("btn-primary");
        buttonupdate.disabled = !inputfile.files.length > 0;
    });
</script>
<?php include '../template/footer.php' ?>